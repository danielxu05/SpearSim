const express = require('express');
const app = new express();
var mysql = require('mysql');
const { User } = require('socket.io.users');
var md5 = require('md5');


app.set('view engine','ejs')
app.use(express.static('public'))
app.get('/',(req,res)=>{
    res.render('index')
})

server = app.listen(3000)

var db_config = {
    host: "",
user: "",
password: "",
port:'',
database:"",
socketPath: '/opt/bitnami/mysql/tmp/mysql.sock'
};
var con;

function handleDisconnect() {
con = mysql.createConnection(db_config); // Recreate the connection, since
                                                // the old one cannot be reused.

con.connect(function(err) {              // The server is either down
    if(err) {                                     // or restarting (takes a while sometimes).
    console.log('error when connecting to db:', err);
    setTimeout(handleDisconnect, 2000); // We introduce a delay before attempting to reconnect,
    }                                     // to avoid a hot loop, and to allow our node script to
});                                     // process asynchronous requests in the meantime.
                                        // If you're also serving http, display a 503 error.
con.on('error', function(err) {
    console.log('db error', err);
    if(err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the MySQL server is usually
    handleDisconnect();                         // lost due to either server restart, or a
    } else {                                      // connnection idle timeout (the wait_timeout
    throw err;                                  // server variable configures this)
    }
});
}

handleDisconnect();

var user_num = 0
const io = require("socket.io")(server)
var checked_list = []
var username_list = []


//listen on every connection
io.on('connection', (socket) => {
    user_num = user_num + 1 
    console.log('New user connected and currently user amount is ',user_num)
    console.log('IO DEBUG: Socket '+ socket.id+ ' is ready \n');
    console.log('number of checked in users: ',checked_list.length)

    socket.on('disconnect', function(){
        user_num = user_num - 1
        try{
            var local_index = checked_list.indexOf(socket.id);

            checked_list = checked_list.filter(function(value, index, arr){
                return value!=socket.id
            })


            username_list = username_list.filter(function(value,index,arr){
                return index!=local_index;
            })

        }catch{
            console.log(socket.id,' quit before input information')
        }
        //console.log('user disconnected and currently user ammount is: ', user_num);
        //console.log(username_list)
    });

    //listen on submitusername
    socket.on('change_username', (data) => {
        socket.username = data.username
        UserID = md5(data['username']);
        var sql = "Select GroupID from GroupRel WHERE AttackerID = '"+UserID+"'or UserID1 = '"+UserID+"'or UserID2 = '"+UserID+"'or UserID3 = '"+UserID+"'";
        console.log(username_list);
        check_duplicate(UserID)
        con.query(sql,function(err,result){
            if(result.length==0){
                //waiting panel 
                checked_list.push(socket.id)
                username_list.push(data['username'])
                console.log(data['username'])
                check_status()
            }
            else{
                io.to(socket.id).emit('participanttwice')
            }
        }) 
    })

    socket.on('nogroup',function(data){
        username = data['username']
        var sql = "Insert into ungroupedUser (UserID) VALUES ('"+username+"')"
        con.query(sql,function(err,result){
            if (err) throw err;
        })

    })

    function check_duplicate(UserID){
        for (var i =0;i< username_list.length;i++){
            if (username_list[i] == UserID){
                io.to(socket.id).emit('participanttwice')
            }
        }
    }

    function check_status(){
        if (checked_list.length >=4){
            for(var i = 0; i <3;i++){
                socketid = checked_list[i]
                io.to(socketid).emit('ping',1,0,username_list[i])
            }
            io.to(checked_list[3]).emit('ping',1,1,username_list[3])
            insertIDs(socket.id,username_list[3],username_list[0],username_list[1],username_list[2])
        }
    }

    function insertIDs(groupID,AttackerID,UserID1,UserID2,UserID3){
//        md5sum.digest('hex');

        var sql = "INSERT INTO GroupRel (GroupID, AttackerID,UserID1,UserID2,UserID3) VALUES ('"+groupID+"','"+md5(AttackerID)+"','"+md5(UserID1)+"','"+md5(UserID2)+"','"+md5(UserID3)+"')"
        console.log(sql);
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("1 record inserted");
        });
    }
})

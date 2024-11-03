var io = require('socket.io')(5000)
console.log('connected to port 5000')

io.on('error', function(socket){
    console.log('error: ' + socket)
})
io.on('connection', function(socket){
    console.log('co nguoi vua ket noi'+socket.id)
})
var Redis = require('ioredis')
var redis = new Redis(6379)
redis.psubscribe("*",function(error, count) {

})
redis.on('pmessage', function(partner, channel, message){
    console.log('partner: ' + partner)
    console.log('channel: ' + channel)
    console.log('message: ' + message)
    message = JSON.parse(message)
    io.emit(channel + ':'+message.event,message.data.message)
    console.log('send')
})

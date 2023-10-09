import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '7d31d658e7933427f381',
    cluster: 'eu',
    encrypted: true
});

require('./bootstrap');



import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '7d31d658e7933427f381',
    cluster: 'eu',
    encrypted: true
});


require('alpinejs');

window.Echo.private(`App.Models.User.${userId}`)
    .notification(function(data) {
        $('#notificationsList').prepend(`<li class="notifications-not-read">
            <a href="${data.url}?notify_id=${data.id}">
                <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                <span class="notification-text">
                    <strong>*</strong>
                    ${data.body}
                </span>
            </a>
        </li>`);
        let count = Number($('#newNotifications').text())
        count++;
        if (count > 99) {
            count = '99+';
        }
        $('#newNotifications').text(count)
    })

 

    window.Echo.join(`messages.${userId}`)
    .listen('.message.created', function(data) {
        alert(data.message.message)
    })
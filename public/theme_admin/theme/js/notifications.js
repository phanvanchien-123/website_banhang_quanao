$(document).ready(function() {
    function fetchNotifications() {
        $.ajax({
            url: fetchNotificationsUrl, // URL sẽ được thiết lập trong view Blade
            method: 'GET',
            success: function(data) {
                if (data.length > 0) {
                    data.forEach(function(notification) {
                        // Display the notification using Toastr
                        toastr.info(notification.data.message, '', {
                            closeButton: true
                        });

                        // Append notification to the container
                        $('#notifications-container').append(
                            `<div class="notification">
                                ${notification.data.message}
                                <small>${new Date(notification.created_at).toLocaleString()}</small>
                            </div>`
                        );
                    });
                }
            }
        });
    }

    function showFlashMessage() {
        if (typeof paymentSuccessMessage !== 'undefined') {
            toastr.success(paymentSuccessMessage, '', {
                closeButton: true,
                timeOut: 0,
                extendedTimeOut: 0
            });
        }
    }

    // Fetch notifications every 30 seconds
    setInterval(fetchNotifications, 30000);

    // Fetch notifications on page load
    fetchNotifications();

    // Show flash message on page load
    showFlashMessage();
});
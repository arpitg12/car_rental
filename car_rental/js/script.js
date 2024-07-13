// Example JavaScript for handling client-side interactions
$(document).ready(function() {
    // Example: Handle renting a car
    $(document).on('click', '.rent-car', function(e) {
        e.preventDefault();
        var carId = $(this).data('car-id');
        var startDate = prompt("Enter start date (YYYY-MM-DD):");
        var days = prompt("Enter number of days:");
        
        if (startDate && days) {
            $.ajax({
                url: '../backend/rent_car.php',
                type: 'POST',
                data: { car_id: carId, start_date: startDate, days: days },
                success: function(response) {
                    alert(response);
                    // Optionally, update UI or redirect to another page
                },
                error: function() {
                    alert('Error renting the car. Please try again later.');
                }
            });
        } else {
            alert('Please enter valid start date and days.');
        }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const container = document.querySelector('.container');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const count = document.getElementById('count');
const total = document.getElementById('total');
const movieSelect = document.getElementById('movie');

populateUI();

let ticketPrice = +movieSelect.value;

    // Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
    localStorage.setItem('selectedMovieIndex', movieIndex);
    localStorage.setItem('selectedMoviePrice', moviePrice);
}

    // Update total and count
function updateSelectedCount() {
    const selectedSeats = document.querySelectorAll('.row .seat.selected');

    const seatsIndex = [...selectedSeats].map(seat => [...seats].indexOf(seat));

    localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

    const selectedSeatsCount = selectedSeats.length;

    count.innerText = selectedSeatsCount;
    total.innerText = selectedSeatsCount * ticketPrice;

    setMovieData(movieSelect.selectedIndex, movieSelect.value);
}

    // Get data from localstorage and populate UI
function populateUI() {
    const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

    if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
    if (selectedSeats.indexOf(index) > -1) {
    seat.classList.add('selected');
}
});
}
    const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

    if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
    }
}

    // Movie select event
    movieSelect.addEventListener('change', e => {
    ticketPrice = +e.target.value;
    setMovieData(e.target.selectedIndex, e.target.value);
    updateSelectedCount();
});

    // Seat click event
    container.addEventListener('click', e => {
    if (
    e.target.classList.contains('seat') &&
    !e.target.classList.contains('occupied')
    ) {
    e.target.classList.toggle('selected');

    updateSelectedCount();
    }
});

    // Initial count and total set
    updateSelectedCount();
    function Pay() {
        var money = $("#total").text();
        var movie_id = $(".movie-id").val();
        var movie_name = $(".movie-name").val();
        var user_id = $(".user-id").val();
        var seat = [];
        var selected = document.querySelectorAll('.row .seat.selected');
        for (let key in selected){
            if (key == 'entries'){
                break;
            }
            seat.push(selected[key].attributes.name.value)
        }

        $.ajax({
            type: 'POST',
            data: {seat: seat, money: money, movie_id: movie_id, movie_name: movie_name, user_id: user_id},
            url: '/booking/submit',
            success: function(result) {
            }
        })
        window.location.href = "/payment";
}

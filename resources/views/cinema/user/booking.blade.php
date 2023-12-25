<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- insert header -->
    @include("cinema.template.head")
    @include("cinema.template.navbar")

    <!-- Insert file booking.css -->
    <link rel="stylesheet" href="/css/booking.css"/>

        <title>Movie Seat Booking</title>
        <script>
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
                window.location.href = "/done";
            }
        </script>
    </head>
<body>
<div class="movie-container">
    <!-- movie's name -->
    <label>Tên phim:</label>
    <select id="movie">
        <option value="10">{{$movie->name}}</option>
    </select>
    <br>
    <!-- showtime -->
    <label>Suất chiếu:</label>
</div>

    <!-- seat classification -->
    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>Ghế chưa chọn</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Ghế đã chọn</small>
        </li>
        <li>
            <div class="seat occupied"></div>
            <small>Ghế đang chọn</small>
        </li>
    </ul>


    <div class="container">
        <p class="text-center">
            Màn hình
        </p>
        <div class="screen"></div>

        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat occupied"></div>
            <div class="seat occupied"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat occupied"></div>
            <div class="seat occupied"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat occupied"></div>
            <div class="seat occupied"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat occupied"></div>
            <div class="seat occupied"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat occupied"></div>
            <div class="seat"></div>
        </div>
    </div>

    <p class="text">
        Bạn đã chọn  <span id="count">0</span> ghế trên tổng số <span
            id="total">0</span> ghế đã đặt
    </p>
    <button class="button" onclick="Pay()">Thanh toán</button>

</div>
@include('cinema.template.footer')
</body>
</html>

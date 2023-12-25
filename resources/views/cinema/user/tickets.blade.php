<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- include header -->
    @include("cinema.template.head")
    @include("cinema.template.navbar")

    <!-- Insert file booking.css -->
    <link rel="stylesheet" href="/css/tickets.css"/>
    <title>Chọn vé xem phim</title>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');

            quantityInput.addEventListener('input', calculatePrice);

            function calculatePrice() {
                const quantity = quantityInput.value;
                const totalPrice = 45000 * quantity;
                priceInput.value = totalPrice.toLocaleString() + ' đồng';
            }
        });
        const seatButton = document.getElementById("seatButton");

        seatButton.addEventListener("click", function() {
            // redirect booking
            window.location.href = "http://127.0.0.1:8000/booking";
        });
        function Book() {
            window.location.href = "/booking";
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Chọn vé xem phim</h1>

    <div class="movie-details">
        <h2>Avengers: Endgame</h2>
        <div class="movie-poster">
            <img src="https://cinestar.com.vn/pictures/Cinestar/12-2023/napoleon-poster.jpg" alt="Avengers: Endgame Poster" width="300">
        </div>
    </div>
    <h3>Thông tin chi tiết </h3>
    <table>
    <tr>
        <td>Tên phim:</td>
        <td>Avengers: Endgame</td>
    </tr>
    <tr>
        <td>Ngày chiếu:</td>
        <td>25/12/2023</td>
    </tr>
    <tr>
        <td>Suất chiếu:</td>
        <td>19:00</td>
    </tr>
    </table>
    <form>

        <div class="form-group">
            <label for="quantity">Số lượng vé:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
        </div>
        <div class="form-group">
            <label>Giá vé: 45.000 đồng</label>
        </div>
        <div class="form-group">
            <label for="price">Thành tiền:</label>
            <input type="text" id="price" name="price" readonly>
        </div>
    </form>
    <button class="seatButton" onclick="Book()">Chọn ghế</button>
</div>
@include('cinema.template.footer')
</body>
</html>

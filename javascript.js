// top


let moon = document.getElementById('moon')
let stars = document.getElementById('stars')
let mountains_behind = document.getElementById('mountains_behind')
let mountains_front = document.getElementById('mountains_front')
let text = document.getElementById('text')
let btn = document.getElementById('btn')
let header = document.querySelector('header')

window.addEventListener('scroll', function() {
    let value = window.scrollY
    stars.style.left = value * 0.25 + 'px'
    moon.style.top = value + 'px'
    mountains_behind.style.top = value * 0.3 + 'px'
    text.style.marginRight = value * 1.5 + 'px'
    text.style.marginTop = value * 0.3 + 'px'
    // btn.style.marginTop = value + 'px'
    header.style.top = value * 0.9 + 'px'

})
// Hiển thị hoặc ẩn nút "Quay lại đầu trang" khi cuộn trang


// Sử dụng jQuery để làm mềm cuộn (scroll) của trang web từ trên xuống đối với id: submitBtn



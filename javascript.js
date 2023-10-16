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
    btn.style.marginTop = value + 'px'
    header.style.top = value * 0.9 + 'px'

})

// todo
let addButton = document.getElementsByClassName('btnAddTask')[0]
let textInput = document.getElementById('textInput')
let taskTodo = document.getElementById('taskTodo')
let editToDoList = document.getElementById('toDoList')
let reset = document.getElementById('reset')
let addTaskIcon = document.getElementById('addTaskIcon')
let toastMess = document.getElementsByClassName('toastMessage')[0]
let tasks = localStorage.getItem('tasks') ? JSON.parse(localStorage.getItem('tasks')) : []

renderTasks(tasks)
addButton.classList.add('disabled')
addTaskIcon.setAttribute('class', 'fas fa-plus-circle')

textInput.addEventListener('keyup', function () {
    if (textInput.value === '') {
        addButton.classList.add('disabled')
    } else if (textInput.value) {
        addButton.classList.remove('disabled')
    }
})

window.addEventListener('keydown', (e) => {
    if (e.which === 13) {
        add()
    }
})

addButton.addEventListener('click', add)





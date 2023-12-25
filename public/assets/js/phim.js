row = document.querySelector(".row").querySelectorAll("button");
console.log(row);

row.forEach(element => {
    element.addEventListener("click",function(){
        row.forEach(list=>list.classList.remove("active"))
        this.classList.add("active");
    })
})
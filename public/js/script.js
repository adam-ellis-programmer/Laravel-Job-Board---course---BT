document.querySelector("#hamburger").addEventListener("click", function () {
    const menu = document.getElementById("mobile-menu");
    menu.classList.toggle("hidden");
    console.log("hello");
});

const test = {
    name: "Sally",
    lastName: "Sue",
    sayHello: function(customName) {
        if (customName) {
            console.log(`Hello my name is ${customName}`);
        } else {
            console.log(`Hello my name is ${this.lastName}`);
        }
    },
};

test.sayHello(); 

// :--> There's a scope issue in your code. 
// :--> In the arrow function, lastName is not 
// :--> defined within the function's scope. 
// :--> Arrow functions don't create their 
// :--> own this binding, but they 
// :--> also don't automatically 
// :--> have access to object 
// :--> properties as 
// :--> variables.



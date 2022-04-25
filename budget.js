let incDisplay = document.querySelector("#inc-display p");
let balDisplay = document.querySelector("#bal-display p");
let expDisplay = document.querySelector("#exp-display p");

let expTab = document.querySelector(".exp-tab");
let allTab = document.querySelector(".all-tab");
let incTab = document.querySelector(".inc-tab");

let expList = document.querySelector(".exp-list .list");
let incList = document.querySelector(".inc-list .list");
let allList = document.querySelector(".all-list .list");

let expenses = document.querySelector(".exp-list");
let income = document.querySelector(".inc-list");
let all = document.querySelector(".all-list");

let incomeDesc = document.querySelector("#inc-desc");
let incomeAmt = document.querySelector("#inc-amount");
let addInc = document.querySelector("#add-inc");

let expenseDesc = document.querySelector("#exp-desc");
let expenseAmt = document.querySelector("#exp-amount");
let addExp = document.querySelector("#add-exp");

let modal = document.querySelector("#modal");

expTab.addEventListener("click", function showOthers(){
  allTab.classList.remove("active");
  incTab.classList.remove("active");
  allTab.classList.add("hide");
  incTab.classList.add("hide");
  expTab.classList.remove("hide");
  expTab.classList.add("active");
  
  expenses.classList.remove("inactive");
  all.classList.add("inactive");
  income.classList.add("inactive");
});
incTab.addEventListener("click", function showOthers(){
  allTab.classList.remove("active");
  expTab.classList.remove("active");
  allTab.classList.add("hide");
  expTab.classList.add("hide");
  incTab.classList.remove("hide");
  incTab.classList.add("active");
  
  income.classList.remove("inactive");
  all.classList.add("inactive");
  expenses.classList.add("inactive");
});
allTab.addEventListener("click", function showOthers(){
  incTab.classList.remove("active");
  expTab.classList.remove("active");
  incTab.classList.add("hide");
  expTab.classList.add("hide");
  allTab.classList.remove("hide");
  allTab.classList.add("active");
  
  all.classList.remove("inactive");
  expenses.classList.add("inactive");
  income.classList.add("inactive");
});

/*addInc.addEventListener("click", function(){
  if (!incomeDesc.value || !incomeAmt.value) return;
  
  let incomeEntry = {
    type: "income",
    desc: incomeDesc.value,
    amount: parseFloat(incomeAmt.value)
  };
  Budget.push(incomeEntry);
  console.log(Budget);
});
addExp.addEventListener("click", function(){
  if (!expenseDesc.value || !expenseAmt.value) {
    document.querySelector("#error"). innerHTML = "nooooooooooo, put something"
return}
  
  let expenseEntry = {
    type: "expense",
    desc: expenseDesc.value,
    amount: parseFloat(expenseAmt.value)
  }
  Budget.push(expenseEntry)
  console.log(Budget)
})
*/
function closeModal(event){
 modal.style.display = "none"
 event.preventDefault()
}
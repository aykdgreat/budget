<?php

$error = $tr_amount = $tr_title = "";
$true_today =[];
$true_tomorrow =["stuff"];

if (isset($_POST['add-transaction'])) {
  $tr_title = $_POST['tr-title'];
  $tr_amount = $_POST['tr-amount'];
  $tr_date = $_POST['tr-date'];
  $tr_type = $_POST['tr-type'];
  $tr_option = $_POST['tr-payment-option'];

  if (!(empty($tr_title) && empty($tr_amount) && empty($tr_date) && empty($tr_type) && empty($tr_option))) {
    echo $tr_title;
    echo $tr_amount;
    echo $tr_date;
    echo $tr_type;
    echo $tr_option;
  } else {
    $error = "Add description and amount";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyBudgeter - Home</title>
  <link rel="stylesheet" href="css/budget.css" />
  <link rel="stylesheet" href="css/line-awesome.css" type="text/css" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

  <div class="container" id="container">
    <div class="logo">
      My<span class="white">Budget</span>er<small class="white">.app</small>
    </div>
    <div class="card-group">
      <div class="card bal">
        <h4>Total Balance</h4>
        <p># 4000</p>
      </div>
      <div class="card-group-inner-grid">
        <div class="card inc">
          <h4>Total Income <i class="la la-arrow-alt-circle-down"></i></h4>
          <p># 9000</p>
        </div>
        <div class="card exp">

          <h4>Total Expense <i class="la la-arrow-alt-circle-up"></i></h4>
          <p># 5000</p>
        </div>
      </div>
    </div>
   
  <div class="body">
      <div class="toggle">
        <div class="hist-tab hide">
          History
        </div>
        <div class="recent-tab active">
          Recent Transactions
        </div>
        <div class="inc-tab hide">
          Income
        </div>
      </div>
      <div class="hist-list inactive">
        <ul class="list">
          <li>
            <div>
              <span class="title">li.desc</span>
              <span class="amount"># 4,000</span>
              <span class="date">li.date</span>
              <!-- <span class="edit right"><i class="las la-edit"></i></span>
              <span class="delete right"><i class="las la-trash"></i></span> -->
            </div>
          </li>
        </ul>
        <!-- <ul class="list">No expense recorded, add below!</ul> -->
      </div>

      
      <div class="recent-list active">
        <span class="date">Today - <?php echo date("Y-m-d", strtotime("today")); ?></span>
        <?php if (!empty($true_today)) : ?>
          <ul class="list">
            <li class="card-small clearfix">
              <div>
                <span class="title">1. li.title <i class="las la-hashtag"></i></span>
                <span class="amount"># 4,000</span>
              </div>
            </li>
            <li class="card-small clearfix">
              <div>
                <span class="title">2. li.title <i class="las la-credit-card"></i>
                
              </span>
              <span class="amount"># 4,000</span>
            </div>
          </li>
        </ul>
        <?php else: ?>
          <ul class="list"><li class="card-small clearfix">
            Nothing for today!
          </li> 
        </ul>
        <?php endif; ?>
        <?php if (!empty($true_tomorrow)) : ?>
      <span class="date">Yesterday - <?php echo date("Y-m-d", strtotime("yesterday")); ?></span>
      <ul class="list">
        <li class="card-small clearfix">
          <div>
            <span class="title">1. li.title <i class="las la-hashtag"></i></span>
            <span class="amount"># 4,000</span>
          </div>
        </li>
        <li class="card-small clearfix">
          <div>
            <span class="title">2. li.title <i class="las la-credit-card"></i>
            
          </span>
          <span class="amount"># 4,000</span>
        </div>
      </li>
    </ul>
    <?php else: ?>
      <ul class="list"><li class="card-small clearfix">
        Nothing for today!
      </li> 
    </ul>
    <?php endif; ?>
    
  </div>
  
  <!-- for loop-->
  <div class="inc-list inactive">
        <ul class="list">
          <!-- if income -->
          <li>
            <div><span class="title">li.desc</span><span class="amount">## 4,000</span><span class="date">li.date</span><span class="edit right"> <i class="las la-edit"></i></span> <span class="delete right"> <i class="las la-trash"></i></span></div>
          </li>
        </ul>
        <!-- else -->
        <!-- <ul class="list">No income recorded, add below!</ul> -->
        
        <!-- <div class="form">
      <form method="post">
        <div class="error"><?php echo $error; ?>
        <input type="text" name="inc_desc" placeholder="Description" class="title-input" value="<?php echo $inc_desc; ?>">
        <input type="number" name="inc_amount" placeholder="Amount" class="amt-input" value="<?php echo $inc_amount; ?>">
        <input type="submit" class="add-inc" name="add_inc" value="Add Income">
      </form>
    </div> -->
  </div>
</div>
<div class="form" id="modal">
  <div class="close-modal" onclick="closeModal()">&times;</div>
  <form method="post" action="" class="input-form" onsubmit="closeModal()" autocomplete="off">
    <h2 style="text-align: center; margin-bottom:5px;">New Transaction</h1>
      <div class="error"><?php echo $error . "<br>"; ?></div>
      <table>
        <tr>
          <td class="m-right">
            <label for="tr-title">Title <span class="error">*</span></label>
          </td>
          <td>
            <input type="text" name="tr-title" placeholder="e.g. data purchase" class="title-input" value="<?php echo $tr_title; ?>">
          </td>
        </tr>
        <tr>
          <td class="m-right">
            <label for="tr-amount">Amount <span class="error">*</span></label>
          </td>
          <td>
            <input type="number" name="tr-amount" placeholder="2500" class="amt-input" value="<?php echo $tr_amount; ?>">
          </td>
          </td>
        </tr>
        <tr>
          <td class="m-right">
            <label for="tr-type">Type <span class="error">*</span></label>
          </td>
          <td>
            <select name="tr-type" class="amt-input">
              <option value="income">Income</option>
              <option value="expense">Expense</option>
            </select>
          </td>
          </td>
        </tr>
        <tr>
          <td class="m-right">
            <label for="tr-type">Date <span class="error">*</span></label>
          </td>
          <td>
            <input type="date" name="tr-date" class="amt-input">
          </td>
          </td>
        </tr>
        </tr>
        <tr>
          <td class="m-right">
            <label for="tr-payment-option">Payment Option <span class="error">*</span></label>
          </td>
          </td>
          <td>
            <select name="tr-payment-option" class="amt-input">
              <option value="cash">Cash</option>
              <option value="card">Card</option>
            </select>
          </td>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" class="add-transaction" name="add-transaction" value="Add Transaction">
          </td>
        </tr>
      </table>
  </form>
</div>
</div>


<button class="open-modal" onclick="openModal()"><i class="la la-plus"></i></button>
<!-- <script src="vue.js"></script> -->
  <!-- <script src="vue-script.js"></script> -->
  <script src="budget.js" type="text/javascript"></script>
</body>

</html>
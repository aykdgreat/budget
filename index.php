<?php

$error = $tr_amount = $tr_title = "";

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
  <link rel="stylesheet" href="budget.css" />
  <link rel="stylesheet" href="css/line-awesome.css" type="text/css" />

</head>

<body>

  <div class="container" id="container">
    <div class="logo">
      My<span class="white">Budget</span>er<small class="white">.app</small>
    </div>
    <div class="card">card</div>
    <!-- <div class="display">
      <div class="income" id="inc-display">
        <h3>Income</h3>
        <p>
          # 5000
        </p>
      </div>
      <div class="balance" id="bal-display">
        <h3>Balance</h3>
        <p>
          # 4000
        </p>
      </div>
      <div class="expense" id="exp-display">
        <h3>Expenses</h3>
        <p>
          # 3000
        </p>
      </div>
    </div> -->
    <!--<input type="date" name="" id="" value="y" @blur="getValue($event)" />-->
    <div class="body">
      <div class="toggle">
        <div class="exp-tab active">
          Expenses
        </div>
        <div class="all-tab hide">
          Recent
        </div>
        <div class="inc-tab hide">
          Income
        </div>
      </div>
      <div class="exp-list">
        <ul class="list">
          <li>
            <div>
              <span class="title">li.desc</span>
              <span class="amount">li.amount</span>
              <span class="date">li.date</span>
              <span class="edit right"><i class="las la-edit"></i></span>
              <span class="delete right"><i class="las la-trash"></i></span>
            </div>
          </li>
        </ul>
        <!-- <ul class="list">No expense recorded, add below!</ul> -->
      </div>

      <!-- <div class="form" id="modal">
        <form method="post" action="" class="input-form" onsubmit="closeModal()" autocomplete="off">
          <div class="close-form" onclick="closeModal()">&times;</div>
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
                  <input type="submit" class="add-exp" name="add-transaction" value="Add Transaction">
                </td>
              </tr>
            </table>
        </form>
      </div> -->

      <div class="all-list inactive">
        <ul class="list">
          <li>
            <div><span class="title">li.desc</span><span class="amount">#li.amount</span><span class="date">li.date</span>
              <!-- <span class="edit right" @click="editEl(input)"> <i class="las la-edit"></i></span> <span class="delete right" @click="deleteEl(index)"> <i class="las la-trash"></i></span> -->
            </div>
          </li>
        </ul>
        <!-- <ul class="list">Nothing in budget recorder!</ul> -->
      </div>

      <!-- for loop-->
      <div class="inc-list inactive">
        <ul class="list">
          <!-- if income -->
          <li>
            <div><span class="title">li.desc</span><span class="amount">#li.amount</span><span class="date">li.date</span><span class="edit right"> <i class="las la-edit"></i></span> <span class="delete right"> <i class="las la-trash"></i></span></div>
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
  </div>

  <!-- <script src="vue.js"></script> -->
  <!-- <script src="vue-script.js"></script> -->
  <script src="budget.js" type="text/javascript"></script>
</body>

</html>
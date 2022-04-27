<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "budget");

if(!$conn) {
  die("Connection error:". mysqli_connect_error());
}

$error = $tr_amount = $tr_title = $tr_date = $tr_type = $tr_option = "";
$today = date("Y-m-d", strtotime("today"));
$yesterday = date("Y-m-d", strtotime("yesterday"));

$read_all = "SELECT * FROM b_tracker";
$result = mysqli_query($conn, $read_all);
if (mysqli_num_rows($result) > 0) {
  $tr_all = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // print_r($tr_all);
}

$read_today = "SELECT * FROM b_tracker WHERE date_ = '$today'";
$result = mysqli_query($conn, $read_today);
if (mysqli_num_rows($result) > 0) {
  $tr_today = mysqli_fetch_all($result, MYSQLI_ASSOC);
  print_r($tr_today);
}

$read_yesterday = "SELECT * FROM b_tracker WHERE date_ = '$yesterday'";
$result = mysqli_query($conn, $read_yesterday);
if (mysqli_num_rows($result) > 0) {
  $tr_yesterday = mysqli_fetch_all($result, MYSQLI_ASSOC);
  print_r($tr_yesterday);
}


if (isset($_POST['add-transaction'])) {
  $tr_title = trim($_POST['tr-title']);
  $tr_amount = $_POST['tr-amount'];
  $tr_date = $_POST['tr-date'];
  $tr_type = $_POST['tr-type'];
  $tr_option = $_POST['tr-payment-option'];

  if (!(empty($tr_title) || empty($tr_amount) || empty($tr_date) || empty($tr_type) || empty($tr_option))) {
    if (!(str_word_count($tr_title) > 40)) {
      $tr_title = mysqli_real_escape_string($conn, $tr_title);
      $tr_amount = mysqli_real_escape_string($conn, $tr_amount);
  
      $create = "INSERT INTO b_tracker (title_, amount_, type_, date_, option_) VALUES('$tr_title', '$tr_amount', '$tr_type', '$tr_date', '$tr_option')";
      $query = mysqli_query($conn, $create);
      if($query) {
        header("location: index.php?insert=success");
      } else {
        die("Error:". mysqli_error($conn));
      }
    } else {
      $error = "<span id='error-msg'>Title longer than 40</span>";
    }
  } else {
    $error = "<span id='error-msg'>* Required</span>";
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
          Recent
        </div>
        <div class="inc-tab hide">
          Income
        </div>
      </div>

      <div class="hist-list inactive">
        <div class="card-group-inner-grid">
          <div class="card inc">
            <span>Income: </span>
            <span>#1000</span>
          </div>
          <div class="card exp">
            <span>Expense: </span>
            <span>- #3000</span>
          </div>
        </div>

        <div class="filter">
          <form method="get" name="history" class="card-group-inner-grid">
            <div class="hundred">
              <label for="month">Month: </label>
              <select name="month" class="input-field select">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
            </div>
            <div class="hundred">
              <label for="order">Order: </label>
              <select name="order" class="input-field select">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
              </select>
            </div>
          </form>
        </div>

        <span class="date"><?php echo date("Y-m-d", strtotime("today")); ?></span>
        <?php if (!empty($true_hist)) : ?>
          <ul class="list">
            <li class="card-small clearfix">
              <div>
                <span class="title">1. So what if this happens to pass its boundary <i class="las la-hashtag"></i></span>
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
        <?php else : ?>
          <ul class="list">
            <li class="card-small clearfix">
              Nothing for today!
            </li>
          </ul>
        <?php endif; ?>
        <?php if (!empty($true_tomorrow)) : ?>
          <span class="date"><?php echo date("Y-m-d", strtotime("yesterday")); ?></span>
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
        <?php else : ?>
          <ul class="list">
            <li class="card-small clearfix">
              Nothing for today!
            </li>
          </ul>
        <?php endif; ?>
      </div>

      <div class="recent-list active">
        <span class="date">Today - <?php echo $today ?></span>
        <?php if (!empty($tr_today)) : ?>
          <ul class="list">
            <?php foreach ($tr_today as $tr): 
              if ($tr['date_'] == $today):
              ?>
            <li class="card-small clearfix">
              <div>
                <span class="title">0. <?php echo $tr['title_']; ?> <i class="las la-hashtag"></i></span>
                <span class="amount"># <?php echo $tr['amount_']; ?></span>
              </div>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <ul class="list">
            <li class="card-small clearfix">
              Nothing for today!
            </li>
          </ul>
          <?php endif; ?>
          
        <span class="date">Yesterday - <?php echo $yesterday; ?></span>
        <?php if (!empty($tr_yesterday)) : ?>
          <ul class="list">
            <?php foreach ($tr_yesterday as $tr): 
              if ($tr['date_'] == $yesterday):
                ?>
            <li class="card-small clearfix">
              <div>
              <span class="title">1. <?php echo $tr['title_']; ?> <i class="las la-<?php echo $tr['option_'] == 'cash' ? 'hashtag' : 'credit-card';?>"></i></span>
              <span class="<?php echo $tr['type_'] == 'income' ? 'i-type_' : 'e-type_'; ?>"># <?php echo $tr['amount_']; ?></span>
            </div>
          </li>
          <?php endif; ?>
          <?php endforeach; ?>
        </ul>
        <?php else : ?>
          <ul class="list">
            <li class="card-small clearfix">
              Nothing recorded yesterday!
            </li>
          </ul>
          <?php endif; ?>
          
      </div>

      <div class="inc-list inactive">
        <ul class="list">
          <li class="card-small">
          </li>
        </ul>
      </div>
    </div>
    
    <div class="form" id="modal">
      <div class="close-modal" onclick="closeModal()">&times;</div>
      <form method="post" class="input-form" autocomplete="off">
        <h2 style="text-align: center; margin-bottom:5px;">New Transaction</h1>
          <div class="error" id="error-div">
            <?php echo $error."<br>"; ?>
          </div>
          <table>
            <tr>
              <td class="m-right">
                <label for="tr-title">Title <span class="error">*</span></label>
              </td>
              <td>
                <input type="text" name="tr-title" placeholder="e.g. data purchase" class="input-field" value="<?php echo $tr_title; ?>">
              </td>
            </tr>
            <tr>
              <td class="m-right">
                <label for="tr-amount">Amount <span class="error">*</span></label>
              </td>
              <td>
                <input type="number" name="tr-amount" placeholder="2500" class="input-field" value="<?php echo $tr_amount; ?>">
              </td>
              </td>
            </tr>
            <tr>
              <td class="m-right">
                <label for="tr-type">Type <span class="error">*</span></label>
              </td>
              <td>
                <select name="tr-type" class="input-field">
                  <option value="">Select type</option>
                  <option value="income" <?php if ($tr_type == "income") echo "selected"; ?>>Income</option>
                  <option value="expense" <?php if ($tr_type == "expense") echo "selected"; ?>>Expense</option>
                </select>
              </td>
              </td>
            </tr>
            <tr>
              <td class="m-right">
                <label for="tr-type">Date <span class="error">*</span></label>
              </td>
              <td>
                <input type="date" name="tr-date" class="input-field" value="<?php echo $tr_date; ?>">
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
                <select name="tr-payment-option" class="input-field">
                  <option value="">Select option</option>
                  <option value="cash" <?php if ($tr_option == "cash") echo "selected"; ?>>Cash</option>
                  <option value="card" <?php if ($tr_option == "card") echo "selected"; ?>>Card</option>
                </select>
              </td>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" id="add-transaction" class="add-transaction" name="add-transaction" value="Add Transaction">
              </td>
            </tr>
          </table>
      </form>
    </div>
    <footer>Copyright &copy; <?php echo date("Y"); ?> <a href="http://github.com/aykdgreat">AYKdgreat</a></footer>
  </div>

  <button class="open-modal" onclick="openModal()"><i class="la la-plus"></i></button>
  <script src="budget.js" type="text/javascript"></script>
</body>

</html>
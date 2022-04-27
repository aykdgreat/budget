<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "budget");

# CONNECTION
if (!$conn) {
  die("Connection error:" . mysqli_connect_error());
}

# GLOBALS
$error = $tr_amount = $tr_title = $tr_date = $tr_type = $tr_option = "";
$today = date("Y-m-d", strtotime("today"));
$yesterday = date("Y-m-d", strtotime("yesterday"));
$month = date("F", strtotime("today"));

# ALL TR
$read_all = "SELECT * FROM b_tracker";
$result = mysqli_query($conn, $read_all);
if (mysqli_num_rows($result) > 0) {
  $tr_all = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // print_r($tr_all);
}

# TODAY TR
$read_today = "SELECT * FROM b_tracker WHERE date_ = '$today'";
$result = mysqli_query($conn, $read_today);
if (mysqli_num_rows($result) > 0) {
  $tr_today = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // print_r($tr_today);
}

# YESTERDAY TR
$read_yesterday = "SELECT * FROM b_tracker WHERE date_ = '$yesterday'";
$result = mysqli_query($conn, $read_yesterday);
if (mysqli_num_rows($result) > 0) {
  $tr_yesterday = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // print_r($tr_yesterday);
}

# ADD NEW TRANSACTION
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
      if ($query) {
        header("location: index.php?insert=success");
      } else {
        die("Error:" . mysqli_error($conn));
      }
    } else {
      $error = "<span id='error-msg'>Title longer than 40</span>";
    }
  } else {
    $error = "<span id='error-msg'>* Required</span>";
  }
}

# HISTORY
$read_history = "SELECT * FROM b_tracker where MONTHNAME(date_) = 'April'";
$result = mysqli_query($conn, $read_history);
if (mysqli_num_rows($result) > 0) {
  $tr_history = mysqli_fetch_all($result, MYSQLI_ASSOC);
  print_r($tr_history);
  echo count($tr_history);
}

if (isset($_GET['view-history'])) {
  $hist_month = $_GET['hist-month'];
  $hist_order = $_GET['hist-order'];
  echo 'get history orderby';
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
        <div class="hist-tab active">
          History
        </div>
        <div class="recent-tab hide">
          Recent
        </div>
        <div class="inc-tab hide">
          Income
        </div>
      </div>

      <div class="hist-list active">
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
          <form method="get" name="history" class="card-group-inner-grid-three">
            <div class="hundred">
              <label for="hist-month">Month: </label>
              <select name="hist-month" class="input-field select">
                <option value="January" <?php if ($month == "January") echo "selected" ?>>January</option>
                <option value="February" <?php if ($month == "February") echo "selected" ?>>February</option>
                <option value="March" <?php if ($month == "March") echo "selected" ?>>March</option>
                <option value="April" <?php if ($month == "April") echo "selected" ?>>April</option>
                <option value="May" <?php if ($month == "May") echo "selected" ?>>May</option>
                <option value="June" <?php if ($month == "June") echo "selected" ?>>June</option>
                <option value="July" <?php if ($month == "July") echo "selected" ?>>July</option>
                <option value="August" <?php if ($month == "August") echo "selected" ?>>August</option>
                <option value="September" <?php if ($month == "September") echo "selected" ?>>September</option>
                <option value="October" <?php if ($month == "October") echo "selected" ?>>October</option>
                <option value="November" <?php if ($month == "November") echo "selected" ?>>November</option>
                <option value="December" <?php if ($month == "December") echo "selected" ?>>December</option>
              </select>
            </div>
            <div class="hundred">
              <label for="hist-order">Order: </label>
              <select name="hist-order" class="input-field select">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
              </select>
            </div>
            <div class="hundred">
              <input type="submit" value="View" class="view-history" name="view-history">
            </div>
          </form>
        </div>

        <?php if (!empty($tr_history)) : ?>
          <ul class="list">
            <?php foreach ($tr_history as $tr) : ?>
              <span class="date"><?php echo $tr['date_']; ?></span>
              <li class="card-small clearfix">
                <div>
                  <span class="title">1. <?php echo $tr['title_']; ?> <i class="las la-<?php echo $tr['option_'] == 'cash' ? 'hashtag' : 'credit-card'; ?>"></i></span>
                  <span class="amount <?php echo $tr['type_'] == 'income' ? 'i-type_' : 'e-type_'; ?>"># <?php echo $tr['amount_']; ?></span>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <ul class="list">
            <li class="card-small clearfix">
              Nothing for today!
            </li>
          </ul>
        <?php endif; ?>
      </div>

      <div class="recent-list inactive">
        <span class="date">Today - <?php echo $today ?></span>
        <?php if (!empty($tr_today)) : ?>
          <ul class="list">
            <?php foreach ($tr_today as $tr) :
              if ($tr['date_'] == $today) :
            ?>
                <li class="card-small clearfix">
                  <div>
                    <span class="title">1. <?php echo $tr['title_']; ?> <i class="las la-<?php echo $tr['option_'] == 'cash' ? 'hashtag' : 'credit-card'; ?>"></i></span>
                    <span class="amount <?php echo $tr['type_'] == 'income' ? 'i-type_' : 'e-type_'; ?>"># <?php echo $tr['amount_']; ?></span>
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
            <?php foreach ($tr_yesterday as $tr) :
              if ($tr['date_'] == $yesterday) :
            ?>
                <li class="card-small clearfix">
                  <div>
                    <span class="title">1. <?php echo $tr['title_']; ?> <i class="las la-<?php echo $tr['option_'] == 'cash' ? 'hashtag' : 'credit-card'; ?>"></i></span>
                    <span class="amount <?php echo $tr['type_'] == 'income' ? 'i-type_' : 'e-type_'; ?>"># <?php echo $tr['amount_']; ?></span>
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
            <?php echo $error . "<br>"; ?>
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
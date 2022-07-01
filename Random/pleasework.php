<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="icon" type="image/x-icon" href="images\Mariehaugif.png">
    <!-- required for proper phone support -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS goes up here for bootrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="custom.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>

function openmodal() {
  // Get the modal
  var yes = document.getElementById("yes");
  // this creates the toast according to the page
  var toast = new bootstrap.Modal(yes)
  // this shows it
  toast.show()

}
</script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="col-8">
        <!-- put table striped here -->
        <table class="table table-dark table-striped table-hover table-bordered">
          <!-- thead is always aligned bottom -->
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
              <th scope="col" class="align-top">Rand text</th>
            </tr>
          </thead>
          <!-- tbody is always aligned top -->
          <tbody >
            <tr class="align-middle">
              <th scope="col">1</th>
              <!-- TD isnt bold th is -->
              <td scope="col">Elite</td>
              <td scope="col">Menzie</td>
              <td scope="col">@Elte</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
    </td>
            </tr class="align-top">
            <!-- table active to make it lighter or darker -->
            <tr class="table-active" onclick='openmodal()'>
              <th scope="col">2</th>
              <td scope="col">Jacob</td>
              <td scope="col">Can</td>
              <td scope="col">@JCAN-ECANT</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
    </td>
            </tr>
            <tr class="align-bottom clickable-row" onclick='openmodal()'>
              <th scope="col">3</th>
              <td scope="col">Ben</td>
              <td scope="col"></td>
              <td scope="col">@yes</td>
              <td scope="col">This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal" id="yes" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

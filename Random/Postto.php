<form action="Post.php" method="post">
  <table>
    <thead>
      <tr>
        <th scope="col" class="w-overide-0"></th>
        <th scope="col">Student Name:</th>
        <th scope="col" class="text-center">Year:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row" class="pt-0 pb-0"><input class="form-check-input display-7 m-0" type="checkbox" name='student[]' value='5' id="flexCheckChecked" checked></th>
        <td>Jacob Horrey</td>
        <td class="text-center">11</td>
      </tr>
      <tr>
        <th scope="row" class="pt-0 pb-0"><input class="form-check-input display-7 m-0" type="checkbox" name='student[]' value='2' id="flexCheckChecked" checked></th>
        <td>Bumsen Burner</td>
        <td class="text-center">12</td>
      </tr>
    </tbody>
  </table>
  <button type="submit">Submit</button>
</form>

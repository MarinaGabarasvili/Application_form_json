<?php include '_header.php'; ?>

<!--Application form-->

    <div style="width: 50%;  margin: 50px auto;">
        <form id="app" action="store.php" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="birthDate" class="col-2 col-form-label">Date of birth</label>
                <div class="col-10">
                    <input class="form-control" type="date" id="birthDate" name="birthDate" required>
                </div>
            </div>

            <div class="custom-file">
                <input type="file" id="file" name="file" required>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-10">

                    <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>

<?php include '_footer.php'; ?>
<!--<section class="after-header">-->
  <div class="container">
    <div class="row">
      <div class="panel panel-primary form-search">
        <div class="panel-body">
          <!-- <form method="POST" action="#" role="form"> -->
          <div class="section-intro text-center">
            <div class="section-intro__style">
              <img style="width:50px; height:50px;" src="<?=base_url()?>assets/images/email.png" alt="">
            </div>
            <h5 class="label-form">Masukan Kode Verifikasi</h5>
          </div>
          <p class="form-group text-center">Kami telah mengirim 6 kode verifikasi ke email anda<br /></p>
          <?php echo form_open('verifikasi/check'); ?>
          <div class="form-group  text-center col-lg-12 ">
            <input id="uintTextBox1" name="kode[]" class="baris inputs text-center" type="text" maxlength="1" autofocus>
            <input id="uintTextBox2" name="kode[]" class="baris inputs text-center" type="text" maxlength="1">
            <input id="uintTextBox3" name="kode[]" class="baris inputs text-center" type="text" maxlength="1">
            <input id="uintTextBox4" name="kode[]" class="baris inputs text-center" type="text" maxlength="1">
            <input id="uintTextBox5" name="kode[]" class="baris inputs text-center" type="text" maxlength="1">
            <input id="uintTextBox6" name="kode[]" class="baris inputs text-center" type="text" maxlength="1">
          </div>
          <button id="verifikasi" type="submit" class="btn btn-info btn-block">Verifikasi</button>
          </form>
          <p></p>Tidak mendapatkan kode? <a href="#">Kirim ulang kode</a></p>
        </div>
      </div>
    </div>
<!--</section>-->
<style media="screen">
  .baris {
    width: 40px;
    height: 40px;
    font-size: 20px;
    font-weight: bold;
    margin: 5px;
  }
</style>
<script type="text/javascript">
  $(".inputs").keyup(function() {
    if (this.value.length == this.maxLength) {
      $(this).next('.inputs').focus();
    }
  });
  // Restricts input for the given textbox to the given inputFilter.
  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
      textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        }
      });
    });
  }
  setInputFilter(document.getElementById("uintTextBox1"), function(value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("uintTextBox2"), function(value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("uintTextBox3"), function(value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("uintTextBox4"), function(value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("uintTextBox5"), function(value) {
    return /^\d*$/.test(value);
  });
  setInputFilter(document.getElementById("uintTextBox6"), function(value) {
    return /^\d*$/.test(value);
  });


  var $inputs = $(".baris");
  var intRegex = /^\d+$/;

  // Prevents user from manually entering non-digits.
  $inputs.on("input.fromManual", function() {
    if (!intRegex.test($(this).val())) {
      $(this).val("");
    }
  });


  // Prevents pasting non-digits and if value is 6 characters long will parse each character into an individual box.
  $inputs.on("paste", function() {
    var $this = $(this);
    var originalValue = $this.val();
    $this.val("");
    $this.one("input.fromPaste", function() {
      $currentInputBox = $(this);
      var pastedValue = $currentInputBox.val();
      if (pastedValue.length == 6 && intRegex.test(pastedValue)) {
        pasteValues(pastedValue);
      } else {
        $this.val(originalValue);
      }
      $inputs.attr("maxlength", 1);
    });
    $inputs.attr("maxlength", 6);
  });


  // Parses the individual digits into the individual boxes.
  function pasteValues(element) {
    var values = element.split("");
    $(values).each(function(index) {
      var $inputBox = $('.baris[id="uintTextBox' + (index + 1) + '"]');
      $inputBox.val(values[index])
    });
  };
</script>

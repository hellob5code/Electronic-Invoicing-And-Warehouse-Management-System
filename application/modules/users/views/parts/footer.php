<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (!empty($myFirms)) { ?>
    </div>
    </div>
    </div> 
    </div>
<?php } ?>
<footer>
    bebe
</footer>
</div> 
</div> 
<?php
if ($this->session->flashdata('resultAction')) {
    geterror($this->session->flashdata('resultAction'));
}
?>
<script src="<?= base_url('assets/plugins/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>  
<script src="<?= base_url('assets/plugins/bootbox.min.js') ?>"></script> 
<script src="<?= base_url('assets/users/js/general.js') ?>"></script> 
</body>
</html>
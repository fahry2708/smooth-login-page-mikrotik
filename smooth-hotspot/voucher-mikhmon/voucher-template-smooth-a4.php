<style>
	@page{
		margin:8mm;
	}
	.qrcode{
		height:66px;
		width:66px;
	}
	/* inline-block: voucher tersusun ke samping (3 per baris di A4), bukan menumpuk ke bawah */
	.sv{
		box-sizing:border-box;
		display:inline-block;
		vertical-align:top;
		width:214px;
		margin:3px;
		font-family:"Segoe UI",Arial,Helvetica,sans-serif;
		color:#12285C;
		background:#fff;
		border:1px solid #02339A;
		border-radius:10px;
		overflow:hidden;
		page-break-inside:avoid;
		break-inside:avoid;
		-webkit-print-color-adjust:exact;
		print-color-adjust:exact;
	}

	/* ===== Header ===== */
	.sv-head{
		position:relative;
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:6px;
		padding:5px 8px;
		color:#fff;
		background:linear-gradient(135deg,#02339A 0%,#1F5BFF 100%);
		overflow:hidden;
	}
	.sv-head::after{
		content:"";
		position:absolute;
		right:-22px;
		top:-30px;
		width:78px;
		height:78px;
		border-radius:50%;
		border:12px solid #5BC1EC;
		opacity:.4;
	}
	.sv-logo{
		position:relative;
		z-index:1;
		flex:none;
		width:87px;
		height:30px;
		overflow:hidden;
		background:#fff;
		border-radius:6px;
	}
	.sv-logo img{
		display:block;
		width:100%;
		height:100%;
		object-fit:cover;
		object-position:center 52%;
		border:0;
	}
	.sv-side{
		position:relative;
		z-index:1;
		text-align:right;
	}
	.sv-head #num{
		display:inline-block;
		padding:0 7px;
		margin-bottom:2px;
		font-size:9px;
		font-weight:bold;
		line-height:13px;
		color:#02339A;
		background:#fff;
		border-radius:99px;
	}
	.sv-tag{
		font-size:8px;
		font-weight:bold;
		line-height:1.2;
	}

	/* ===== Kode ===== */
	.sv-body{padding:6px 8px 5px;}
	.sv-row{display:flex;align-items:center;gap:6px;}
	.sv-main{flex:1;min-width:0;}
	.sv-qr{
		flex:none;
		padding:2px;
		line-height:0;
		background:#fff;
		border:1px solid #C9DBFF;
		border-radius:6px;
	}
	.lbl{
		margin:0 0 2px;
		font-size:9px;
		font-weight:bold;
		color:#5B6B8F;
	}
	.box{
		padding:4px 3px;
		text-align:center;
		font-family:Consolas,"Courier New",monospace;
		font-weight:bold;
		color:#02339A;
		background:#EAF4FF;
		border:1.5px dashed #02339A;
		border-radius:7px;
		word-break:break-all;
	}
	.code{font-size:15px;letter-spacing:.8px;}
	.cred{font-size:12.5px;letter-spacing:.2px;}
	.gap{height:4px;}

	/* ===== Garis potong ===== */
	.sv-cut{
		position:relative;
		height:0;
		border-top:1px dashed #9DB6E8;
	}
	.sv-cut::before,
	.sv-cut::after{
		content:"";
		position:absolute;
		top:-7px;
		width:12px;
		height:12px;
		background:#fff;
		border:1px solid #02339A;
		border-radius:50%;
	}
	.sv-cut::before{left:-7px;}
	.sv-cut::after{right:-7px;}

	/* ===== Paket & harga ===== */
	.sv-foot{
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:6px;
		padding:5px 8px 4px;
	}
	.chips{display:flex;flex-wrap:wrap;gap:3px;}
	.chip{
		padding:1px 7px;
		font-size:10px;
		font-weight:bold;
		line-height:14px;
		color:#02339A;
		background:#EAF4FF;
		border:1px solid #9DB6E8;
		border-radius:99px;
		white-space:nowrap;
	}
	.price{
		font-size:17px;
		font-weight:800;
		color:#02339A;
		white-space:nowrap;
	}

	/* ===== Catatan ===== */
	.sv-note{
		padding:3px 6px 4px;
		text-align:center;
		font-size:8.5px;
		font-weight:bold;
		line-height:1.3;
		color:#12285C;
		background:#F2F8FF;
		border-top:1px solid #D8E3F5;
	}
</style>

<div class="sv">

<!-- Header: logo, nomor, tagline -->
  <div class="sv-head">
    <div class="sv-logo"><img src="<?= $logo; ?>" alt="logo"></div>
    <div class="sv-side">
      <span id="num"><?= " [$num]"; ?></span>
      <div class="sv-tag">Internet Cepat, Stabil<br>&amp; Tanpa Batas</div>
    </div>
  </div>
<!-- /  -->

<!-- Kode voucher / username & password + QR -->
  <div class="sv-body">
    <div class="sv-row">
      <div class="sv-main">

<?php if ($usermode == "vc") { ?>
        <div class="lbl">Kode Voucher</div>
        <div class="box code"><?= $username; ?></div>

<?php } elseif ($usermode == "up") { ?>
        <div class="lbl">Username</div>
        <div class="box cred"><?= $username; ?></div>
        <div class="gap"></div>
        <div class="lbl">Password</div>
        <div class="box cred"><?= $password; ?></div>
<?php } ?>

      </div>
<?php if ($qr == "yes") { ?>
      <div class="sv-qr"><?= $qrcode ?></div>
<?php } ?>
    </div>
  </div>
<!-- /  -->

  <div class="sv-cut"></div>

<!-- Paket & harga -->
  <div class="sv-foot">
    <div class="chips">
<?php if (trim($validity) !== "") { ?>
      <span class="chip"><?= $validity; ?></span>
<?php } ?>
<?php if (trim($timelimit) !== "") { ?>
      <span class="chip"><?= $timelimit; ?></span>
<?php } ?>
<?php if (trim($datalimit) !== "") { ?>
      <span class="chip"><?= $datalimit; ?></span>
<?php } ?>
    </div>
    <div class="price"><?= $price; ?></div>
  </div>
<!-- /  -->

<!-- Catatan -->
  <div class="sv-note">
    Login: http://<?= $dnsname; ?><br>
    CS WhatsApp: 08XX.XXXX.XXXX
  </div>
<!-- /  -->

</div>

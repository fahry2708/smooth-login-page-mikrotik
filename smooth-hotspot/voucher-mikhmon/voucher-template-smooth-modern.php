<style>
	.qrcode{
		height:80px;
		width:80px;
	}
	.sv{
		width:240px;
		font-family:"Segoe UI",Arial,Helvetica,sans-serif;
		color:#12285C;
		background:#fff;
		border:1px solid #02339A;
		border-radius:14px;
		overflow:hidden;
		page-break-inside:avoid;
		-webkit-print-color-adjust:exact;
		print-color-adjust:exact;
	}

	/* ===== Header ===== */
	.sv-head{
		position:relative;
		padding:10px 10px 9px;
		color:#fff;
		background:linear-gradient(135deg,#02339A 0%,#1F5BFF 100%);
		overflow:hidden;
	}
	.sv-head::after{
		content:"";
		position:absolute;
		right:-28px;
		top:-34px;
		width:96px;
		height:96px;
		border-radius:50%;
		border:15px solid #5BC1EC;
		opacity:.45;
	}
	.sv-logo{
		position:relative;
		z-index:1;
		width:112px;
		height:39px;
		overflow:hidden;
		background:#fff;
		border-radius:8px;
	}
	.sv-logo img{
		display:block;
		width:100%;
		height:100%;
		object-fit:cover;
		object-position:center 52%;
		border:0;
	}
	.sv-head #num{
		position:absolute;
		z-index:2;
		right:10px;
		top:10px;
		padding:1px 8px;
		font-size:10px;
		font-weight:bold;
		color:#02339A;
		background:#fff;
		border-radius:99px;
	}
	.sv-tag{
		position:relative;
		z-index:1;
		margin-top:6px;
		font-size:9.5px;
		font-weight:bold;
		letter-spacing:.2px;
	}

	/* ===== Kode ===== */
	.sv-body{padding:11px 10px 9px;}
	.sv-row{display:flex;align-items:center;gap:8px;}
	.sv-main{flex:1;min-width:0;}
	.sv-qr{
		flex:none;
		padding:3px;
		line-height:0;
		background:#fff;
		border:1px solid #C9DBFF;
		border-radius:8px;
	}
	.lbl{
		margin:0 0 3px;
		font-size:10px;
		font-weight:bold;
		color:#5B6B8F;
	}
	.box{
		padding:6px 6px;
		text-align:center;
		font-family:Consolas,"Courier New",monospace;
		font-weight:bold;
		color:#02339A;
		background:#EAF4FF;
		border:1.5px dashed #02339A;
		border-radius:9px;
		word-break:break-all;
	}
	.code{font-size:19px;letter-spacing:1px;}
	.cred{font-size:14px;letter-spacing:.3px;}
	.gap{height:7px;}

	/* ===== Garis potong ===== */
	.sv-cut{
		position:relative;
		height:0;
		margin:2px 0;
		border-top:2px dashed #9DB6E8;
	}
	.sv-cut::before,
	.sv-cut::after{
		content:"";
		position:absolute;
		top:-9px;
		width:16px;
		height:16px;
		background:#fff;
		border:1px solid #02339A;
		border-radius:50%;
	}
	.sv-cut::before{left:-9px;}
	.sv-cut::after{right:-9px;}

	/* ===== Paket & harga ===== */
	.sv-foot{
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:8px;
		padding:9px 10px 8px;
	}
	.chips{display:flex;flex-wrap:wrap;gap:4px;}
	.chip{
		padding:2px 9px;
		font-size:11px;
		font-weight:bold;
		color:#02339A;
		background:#EAF4FF;
		border:1px solid #9DB6E8;
		border-radius:99px;
		white-space:nowrap;
	}
	.price{
		font-size:21px;
		font-weight:800;
		color:#02339A;
		white-space:nowrap;
	}

	/* ===== Catatan ===== */
	.sv-note{
		padding:6px 10px 8px;
		text-align:center;
		font-size:10px;
		font-weight:bold;
		line-height:1.6;
		color:#12285C;
		background:#F2F8FF;
		border-top:1px solid #D8E3F5;
	}
</style>

<div class="sv">

<!-- Header: logo, nomor, tagline -->
  <div class="sv-head">
    <div class="sv-logo"><img src="<?= $logo; ?>" alt="logo"></div>
    <span id="num"><?= " [$num]"; ?></span>
    <div class="sv-tag">Internet Cepat, Stabil &amp; Tanpa Batas</div>
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
    🌐 Login: http://<?= $dnsname; ?><br>
    💬 CS WhatsApp: 08XX.XXXX.XXXX
  </div>
<!-- /  -->

</div>

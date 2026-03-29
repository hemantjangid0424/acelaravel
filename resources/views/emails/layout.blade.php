<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>@yield('title',"{{getAppName()}}")</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}
table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}
body{margin:0!important;padding:0!important;width:100%!important;background:#eef0f6;font-family:'Plus Jakarta Sans',Arial,sans-serif}

.outer{background:#eef0f6;padding:36px 14px 52px}
.wrap{max-width:620px;margin:0 auto;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 2px 4px rgba(0,0,0,.04),0 12px 40px rgba(0,0,0,.10)}

/* HEADER */
.hdr{background:#FFA201;padding:28px 36px 0;position:relative;overflow:hidden}
.hdr-noise{position:absolute;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");opacity:.4}
.hdr-glow{position:absolute;top:-60px;right:-60px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(244,121,32,.18) 0%,transparent 70%);pointer-events:none}
.hdr-top{display:flex;align-items:center;justify-content:space-between;position:relative;z-index:2;padding-bottom:24px;border-bottom:1px solid rgba(255,255,255,.08)}
.logo-img{height:52px;width:auto;display:block}
.hdr-meta{text-align:right}
.hdr-meta-label{font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:black;margin-bottom:3px}
.hdr-meta-val{font-size:12px;font-weight:600;color:black}

/* hero content */
.hdr-hero{position:relative;z-index:2;padding:24px 0 30px}
.eyebrow{display:inline-flex;align-items:center;gap:7px;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:black;margin-bottom:9px}
.eyebrow-line{width:20px;height:2px;background:#f47920;border-radius:2px}
.hdr-h1{font-size:27px;font-weight:800;color:#fff;line-height:1.22;letter-spacing:-.3px}
.hdr-p{font-size:13px;color:black;margin-top:7px;font-weight:300;line-height:1.6}

/* STRIPE */
.stripe{height:4px;background:linear-gradient(90deg,#e63329 0%,#f47920 25%,#f5c400 50%,#3aaa35 75%,#1a88c9 100%)}

/* BODY */
.body{padding:34px 36px 38px}

/* SECTION */
.sh{display:flex;align-items:center;gap:9px;margin:28px 0 12px}
.sh:first-child{margin-top:0}
.sh-dot{width:7px;height:7px;border-radius:50%;background:#f47920;flex-shrink:0}
.sh-txt{font-size:10.5px;font-weight:800;text-transform:uppercase;letter-spacing:2.5px;color:#0e1c3a}
.sh-line{flex:1;height:1px;background:#e8eaf2}

/* DATA CARD */
.dc{border:1.5px solid #e8eaf2;border-radius:12px;overflow:hidden;margin-bottom:4px}
.dr{display:flex;border-bottom:1.5px solid #e8eaf2}
.dr:last-child{border-bottom:none}
.dk{width:38%;padding:10px 14px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:#8c96b5;background:#f5f6fa}
.dv{width:62%;padding:10px 14px;font-size:13.5px;color:#0e1c3a;font-weight:500}
.dv.hi{color:#f47920;font-weight:700}
.dv.dim{color:#b5bdd4;font-style:italic;font-weight:300}

/* PILLS */
.pill{display:inline-block;padding:3px 12px;border-radius:50px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase}
.p-orange{background:#fff2e7;color:#b85208;border:1px solid rgba(244,121,32,.25)}
.p-green{background:#edfaf3;color:#0f5c2c;border:1px solid rgba(58,170,53,.22)}
.p-navy{background:#edf0f8;color:#0e1c3a;border:1px solid rgba(14,28,58,.15)}
.p-yellow{background:#fefce6;color:#7a6000;border:1px solid rgba(245,196,0,.3)}

/* ALERTS */
.alert{border-radius:11px;padding:13px 16px;margin-bottom:22px;display:flex;gap:12px;align-items:flex-start;font-size:13px;line-height:1.65}
.ai{font-size:16px;flex-shrink:0;margin-top:1px}
.a-orange{background:#fff8f2;border:1px solid rgba(244,121,32,.2);color:#7a3608}
.a-green{background:#edfaf3;border:1px solid rgba(58,170,53,.2);color:#0e5228}

/* STEPS */
.step-num{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f47920,#f5a030);color:#fff;font-size:14px;font-weight:800;text-align:center;line-height:36px;flex-shrink:0;box-shadow:0 3px 10px rgba(244,121,32,.3)}

/* BUTTON */
.btn-wrap{text-align:center;margin:24px 0 4px}
.btn{display:inline-block;background:#f47920;color:#fff!important;text-decoration:none;font-size:14px;font-weight:700;padding:14px 38px;border-radius:9px;letter-spacing:.2px;box-shadow:0 4px 18px rgba(244,121,32,.35)}

/* CONTACT BOXES */
.cbox{border:1.5px solid #e8eaf2;border-radius:11px;padding:18px;text-align:center;background:#f9fafd}

/* DIVIDER */
hr.d{border:none;border-top:1.5px solid #e8eaf2;margin:24px 0}

/* FOOTER */
.ftr{background:#FFA201;padding:28px 36px}
.ftr-top{display:flex;justify-content:space-between;align-items:center;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.07);gap:16px;flex-wrap:wrap}
.ftr-logo{height:38px;width:auto}
.ftr-info{font-size:11.5px;color:black;line-height:1.9;text-align:right}
.ftr-info a{color:black;text-decoration:none}
.ftr-links{display:flex;flex-wrap:wrap;justify-content:center;padding-top:16px;gap:0}
.fl{font-size:11px;font-weight:600;color:black;text-decoration:none;padding:0 12px;border-right:1px solid rgba(255,255,255,.09)}
.fl:last-child{border-right:none}
.ftr-copy{text-align:center;font-size:10.5px;color:black;margin-top:16px;padding-top:16px;border-top:1px solid rgba(255,255,255,.06)}

@media screen and (max-width:600px){
.outer{padding:18px 8px 36px}
.hdr,.body,.ftr{padding-left:20px;padding-right:20px}
.hdr-h1{font-size:21px}
.hdr-top{flex-direction:column;align-items:flex-start;gap:12px}
.hdr-meta{text-align:left}
.ftr-top{flex-direction:column}
.ftr-info{text-align:left}
.dk,.dv{font-size:11.5px;padding:9px 11px}
}
</style>
</head>
<body>
<div class="outer">
<div class="wrap">

{{-- HEADER --}}
<div class="hdr">
  <div class="hdr-noise"></div>
  <div class="hdr-glow"></div>
  <div class="hdr-top">
    
    <img src="{{asset('brand.webp')}}" alt="AceTravels USA" class="logo-img"/>
    <div class="hdr-meta">
      
      <div class="hdr-meta-val">acetravelsusa.com</div>
    </div>
  </div>
  @hasSection('hero')
  <div class="hdr-hero">@yield('hero')</div>
  @endif
</div>

{{-- COLOR STRIPE --}}
<div class="stripe"></div>

{{-- CONTENT --}}
<div class="body">
@yield('content')
</div>

{{-- FOOTER --}}
<div class="ftr">
  <div class="ftr-top">
     <img src="{{asset('brand.webp')}}" alt="AceTravels USA" class="logo-img"/>
    <div class="ftr-info">
      2025 Rockledge Dr #130, Rockledge, United States<br>
      <a href="tel:+17323479222">+1 732 347 9222</a> &nbsp;·&nbsp;
      <a href="mailto:{{getInfoEmail()}}">{{getInfoEmail()}}</a>
    </div>
  </div>
  <div class="ftr-copy">&copy; {{ date('Y') }} {{getAppName()}}. All Rights Reserved.</div>
</div>

</div>
</div>
</body>
</html>
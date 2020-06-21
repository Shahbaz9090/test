<style>
p {
	line-height: 11px;
	word-break: break-all;
}
label{
	font-weight:600 !important;
}
.form-actions {
    /*padding: 5px 20px 5px;*/
    margin-top: 30px;
    text-align: left;
    margin-bottom: 20px;
    background-color: #ecf3f7;
    border-top: 1px solid #e5e5e5;
    *: ;
    zoom: 1;
}
.form-row .form-label {
    padding-left: 5px;
   padding-top: 0px;
}
h3 {
    font-size: 18px;
    line-height: 10px;
    padding-left: 10px;
    padding-top: 7px;
}
em{
    color:red;
}
.profile-info-name {    width:25%;}
.equal-width{width: 100% !important;
text-align: left;}
.space-8{clear: both;margin-top:8px;}
.viewed_reminder{color:red;cursor:pointer;}



.widget-box {
  padding: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  margin: 3px 0;
  border: 1px solid #CCC;
}
@media only screen and (max-width: 767px) {
  .widget-box {
    margin-top: 7px;
    margin-bottom: 7px;
  }
}
.widget-header {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  position: relative;
  min-height: 38px;
  background: #f7f7f7;
  background-image: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
  background-image: -o-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
  background-image: linear-gradient(to bottom, #ffffff 0%, #eeeeee 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
  color: #669fc7;
  border-bottom: 1px solid #DDD;
  padding-left: 12px;
}
.widget-header:before,
.widget-header:after {
  content: "";
  display: table;
  line-height: 0;
}
.widget-header:after {
  clear: right;
}
.widget-box.collapsed > .widget-header {
  border-bottom-width: 0;
}
.collapsed.fullscreen > .widget-header {
  border-bottom-width: 1px;
}
.collapsed > .widget-body {
  display: none;
}
.widget-header-flat {
  background: #F7F7F7;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}
.widget-header-large {
  min-height: 49px;
  padding-left: 18px;
}
.widget-header-small {
  min-height: 31px;
  padding-left: 10px;
}
.widget-header > .widget-title {
  line-height: 36px;
  padding: 0;
  margin: 0;
  display: inline;
}
.widget-header > .widget-title > .ace-icon {
  margin-right: 5px;
  font-weight: normal;
  display: inline-block;
}
.widget-header-large > .widget-title {
  line-height: 48px;
}
.widget-header-small > .widget-title {
  line-height: 30px;
}
.widget-toolbar {
  display: inline-block;
  padding: 0 10px;
  line-height: 37px;
  float: right;
  position: relative;
}
.widget-header-large > .widget-toolbar {
  line-height: 48px;
}
.widget-header-small > .widget-toolbar {
  line-height: 29px;
}
.widget-toolbar.no-padding {
  padding: 0;
}
.widget-toolbar.padding-5 {
  padding: 0 5px;
}
.widget-toolbar:before {
  display: inline-block;
  content: "";
  position: absolute;
  top: 3px;
  bottom: 3px;
  left: -1px;
  border: 1px solid #D9D9D9;
  border-width: 0 1px 0 0;
}
.widget-header-large > .widget-toolbar:before {
  top: 6px;
  bottom: 6px;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar:before {
  border-color: #EEE;
}
.widget-color-orange > .widget-header > .widget-toolbar:before {
  border-color: #FEA;
}
.widget-color-dark > .widget-header > .widget-toolbar:before {
  border-color: #222;
  box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2), inset 1px 0 0 rgba(255, 255, 255, 0.1);
}
.widget-toolbar.no-border:before {
  display: none;
}
.widget-toolbar label {
  display: inline-block;
  vertical-align: middle;
  margin-bottom: 0;
}
.widget-toolbar > a,
.widget-toolbar > .widget-menu > a {
  font-size: 14px;
  margin: 0 1px;
  display: inline-block;
  padding: 0;
  line-height: 24px;
}
.widget-toolbar > a:hover,
.widget-toolbar > .widget-menu > a:hover {
  text-decoration: none;
}
.widget-header-large > .widget-toolbar > a,
.widget-header-large > .widget-toolbar > .widget-menu > a {
  font-size: 15px;
  margin: 0 1px;
}
.widget-toolbar > .btn {
  line-height: 27px;
  margin-top: -2px;
}
.widget-toolbar > .btn.smaller {
  line-height: 26px;
}
.widget-toolbar > .btn.bigger {
  line-height: 28px;
}
.widget-toolbar > .btn-sm {
  line-height: 24px;
}
.widget-toolbar > .btn-sm.smaller {
  line-height: 23px;
}
.widget-toolbar > .btn-sm.bigger {
  line-height: 25px;
}
.widget-toolbar > .btn-xs {
  line-height: 22px;
}
.widget-toolbar > .btn-xs.smaller {
  line-height: 21px;
}
.widget-toolbar > .btn-xs.bigger {
  line-height: 23px;
}
.widget-toolbar > .btn-minier {
  line-height: 18px;
}
.widget-toolbar > .btn-minier.smaller {
  line-height: 17px;
}
.widget-toolbar > .btn-minier.bigger {
  line-height: 19px;
}
.widget-toolbar > .btn-lg {
  line-height: 36px;
}
.widget-toolbar > .btn-lg.smaller {
  line-height: 34px;
}
.widget-toolbar > .btn-lg.bigger {
  line-height: 38px;
}
.widget-toolbar-dark {
  background: #444;
}
.widget-toolbar-light {
  background: rgba(255, 255, 255, 0.85);
}
.widget-toolbar > .widget-menu {
  display: inline-block;
  position: relative;
}
.widget-toolbar > a[data-action],
.widget-toolbar > .widget-menu > a[data-action] {
  -webkit-transition: transform 0.1s;
  -o-transition: transform 0.1s;
  transition: transform 0.1s;
}
.widget-toolbar > a[data-action] > .ace-icon,
.widget-toolbar > .widget-menu > a[data-action] > .ace-icon {
  margin-right: 0;
}
.widget-toolbar > a[data-action]:focus,
.widget-toolbar > .widget-menu > a[data-action]:focus {
  text-decoration: none;
  outline: none;
}
.widget-toolbar > a[data-action]:hover,
.widget-toolbar > .widget-menu > a[data-action]:hover {
  -moz-transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}
.widget-body {
  background-color: transparent;
}
.widget-main {
  padding: 12px;
}
.widget-main.padding-32 {
  padding: 32px;
}
.widget-main.padding-30 {
  padding: 30px;
}
.widget-main.padding-28 {
  padding: 28px;
}
.widget-main.padding-26 {
  padding: 26px;
}
.widget-main.padding-24 {
  padding: 24px;
}
.widget-main.padding-22 {
  padding: 22px;
}
.widget-main.padding-20 {
  padding: 20px;
}
.widget-main.padding-18 {
  padding: 18px;
}
.widget-main.padding-16 {
  padding: 16px;
}
.widget-main.padding-14 {
  padding: 14px;
}
.widget-main.padding-12 {
  padding: 12px;
}
.widget-main.padding-10 {
  padding: 10px;
}
.widget-main.padding-8 {
  padding: 8px;
}
.widget-main.padding-6 {
  padding: 6px;
}
.widget-main.padding-4 {
  padding: 4px;
}
.widget-main.padding-2 {
  padding: 2px;
}
.widget-main.padding-0 {
  padding: 0px;
}
.widget-main.no-padding {
  padding: 0;
}
.widget-toolbar .progress {
  vertical-align: middle;
  display: inline-block;
  margin: 0;
}
.widget-toolbar > .dropdown,
.widget-toolbar > .dropup {
  display: inline-block;
}
.widget-box > .widget-header > .widget-toolbar > [data-action="settings"],
.widget-color-dark > .widget-header > .widget-toolbar > [data-action="settings"],
.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"],
.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
  color: #99CADB;
}
.widget-box > .widget-header > .widget-toolbar > [data-action="reload"],
.widget-color-dark > .widget-header > .widget-toolbar > [data-action="reload"],
.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"],
.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
  color: #ACD392;
}
.widget-box > .widget-header > .widget-toolbar > [data-action="collapse"],
.widget-color-dark > .widget-header > .widget-toolbar > [data-action="collapse"],
.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"],
.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
  color: #AAA;
}
.widget-box > .widget-header > .widget-toolbar > [data-action="close"],
.widget-color-dark > .widget-header > .widget-toolbar > [data-action="close"],
.widget-box > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"],
.widget-color-dark > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
  color: #E09E96;
}
.widget-box[class*="widget-color-"] > .widget-header {
  color: #FFF;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}
.widget-color-blue {
  border-color: #307ecc;
}
.widget-color-blue > .widget-header {
  background: #307ecc;
  border-color: #307ecc;
}
.widget-color-blue2 {
  border-color: #5090c1;
}
.widget-color-blue2 > .widget-header {
  background: #5090c1;
  border-color: #5090c1;
}
.widget-color-blue3 {
  border-color: #6379aa;
}
.widget-color-blue3 > .widget-header {
  background: #6379aa;
  border-color: #6379aa;
}
.widget-color-green {
  border-color: #82af6f;
}
.widget-color-green > .widget-header {
  background: #82af6f;
  border-color: #82af6f;
}
.widget-color-green2 {
  border-color: #2e8965;
}
.widget-color-green2 > .widget-header {
  background: #2e8965;
  border-color: #2e8965;
}
.widget-color-green3 {
  border-color: #4ebc30;
}
.widget-color-green3 > .widget-header {
  background: #4ebc30;
  border-color: #4ebc30;
}
.widget-color-red {
  border-color: #e2755f;
}
.widget-color-red > .widget-header {
  background: #e2755f;
  border-color: #e2755f;
}
.widget-color-red2 {
  border-color: #e04141;
}
.widget-color-red2 > .widget-header {
  background: #e04141;
  border-color: #e04141;
}
.widget-color-red3 {
  border-color: #d15b47;
}
.widget-color-red3 > .widget-header {
  background: #d15b47;
  border-color: #d15b47;
}
.widget-color-purple {
  border-color: #7e6eb0;
}
.widget-color-purple > .widget-header {
  background: #7e6eb0;
  border-color: #7e6eb0;
}
.widget-color-pink {
  border-color: #ce6f9e;
}
.widget-color-pink > .widget-header {
  background: #ce6f9e;
  border-color: #ce6f9e;
}
.widget-color-orange {
  border-color: #e8b10d;
}
.widget-color-orange > .widget-header {
  color: #855d10 !important;
  border-color: #e8b10d;
  background: #ffc657;
}
.widget-color-dark {
  border-color: #5a5a5a;
}
.widget-color-dark > .widget-header {
  border-color: #666666;
  background: #404040;
}
.widget-color-grey {
  border-color: #9e9e9e;
}
.widget-color-grey > .widget-header {
  border-color: #aaaaaa;
  background: #848484;
}
.widget-box.transparent {
  border-width: 0;
}
.widget-box.transparent > .widget-header {
  background: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  border-width: 0;
  border-bottom: 1px solid #DCE8F1;
  color: #4383B4;
  padding-left: 3px;
}
.widget-box.transparent > .widget-header-large {
  padding-left: 5px;
}
.widget-box.transparent > .widget-header-small {
  padding-left: 1px;
}
.widget-box.transparent > .widget-body {
  border-width: 0;
  background-color: transparent;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action],
[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action] {
  text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="settings"],
[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
  color: #D3E4ED;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="reload"],
[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
  color: #DEEAD3;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="collapse"],
[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
  color: #E2E2E2;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > [data-action="close"],
[class*="widget-color-"] > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
  color: #FFD9D5;
}
.widget-color-orange > .widget-header > .widget-toolbar > [data-action],
.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action] {
  text-shadow: none;
}
.widget-color-orange > .widget-header > .widget-toolbar > [data-action="settings"],
.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="settings"] {
  color: #559AAB;
}
.widget-color-orange > .widget-header > .widget-toolbar > [data-action="reload"],
.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="reload"] {
  color: #7CA362;
}
.widget-color-orange > .widget-header > .widget-toolbar > [data-action="collapse"],
.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="collapse"] {
  color: #777;
}
.widget-color-orange > .widget-header > .widget-toolbar > [data-action="close"],
.widget-color-orange > .widget-header > .widget-toolbar > .widget-menu > [data-action="close"] {
  color: #A05656;
}
.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) {
  border-width: 0;
}
.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) > .widget-header {
  border: 1px solid;
  border-color: inherit;
}
.widget-box.light-border[class*="widget-color-"]:not(.fullscreen) > .widget-body {
  border: 1px solid;
  border-color: #D6D6D6;
  border-width: 0 1px 1px;
}
.widget-box.no-border {
  border-width: 0;
}
.widget-box.fullscreen {
  position: fixed;
  margin: 0;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #FFF;
  border-width: 3px;
  z-index: 1040;
  -moz-backface-visibility: hidden;
}
.widget-box.fullscreen:not([class*="widget-color-"]) {
  border-color: #AAA;
}
.widget-body .table {
  border-top: 1px solid #E5E5E5;
}
.widget-body .table thead:first-child tr {
  background: #FFF;
}
[class*="widget-color-"] > .widget-body .table thead:first-child tr {
  background: #f2f2f2;
  background-image: -webkit-linear-gradient(top, #f8f8f8 0%, #ececec 100%);
  background-image: -o-linear-gradient(top, #f8f8f8 0%, #ececec 100%);
  background-image: linear-gradient(to bottom, #f8f8f8 0%, #ececec 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff8f8f8', endColorstr='#ffececec', GradientType=0);
}
.widget-body .table.table-bordered thead:first-child > tr {
  border-top-width: 0;
}
.widget-main.no-padding .table {
  margin-bottom: 0;
  border-width: 0;
}
.widget-main.no-padding .table-bordered th:first-child,
.widget-main.no-padding .table-bordered td:first-child {
  border-left-width: 0;
}
.transparent > .widget-body .widget-main .table-bordered > thead > tr > th:last-child,
.widget-main.no-padding .table-bordered > thead > tr > th:last-child,
.transparent > .widget-body .widget-main .table-bordered > tbody > tr > td:last-child,
.widget-main.no-padding .table-bordered > tbody > tr > td:last-child,
.transparent > .widget-body .widget-main .table-bordered > tfoot > tr > td:last-child,
.widget-main.no-padding .table-bordered > tfoot > tr > td:last-child {
  border-right-width: 0 !important;
}
.transparent > .widget-body .widget-main .table-bordered > tbody > tr:last-child > td,
.widget-main.no-padding .table-bordered > tbody > tr:last-child > td {
  border-bottom-width: 0 !important;
}
.table-bordered > thead.thin-border-bottom > tr > th,
.table-bordered > thead.thin-border-bottom > tr > td {
  border-bottom-width: 1px;
}
.widget-body .alert:last-child {
  margin-bottom: 0;
}
.widget-main .tab-content {
  border-width: 0;
}
.widget-toolbar > .nav-tabs {
  border-bottom-width: 0;
  margin-bottom: 0;
  top: auto;
  margin-top: 3px !important;
}
.widget-toolbar > .nav-tabs > li {
  margin-bottom: auto;
}
.widget-toolbar > .nav-tabs > li > a {
  box-shadow: none;
  position: relative;
  top: 1px;
  margin-top: 1px;
}
.widget-toolbar > .nav-tabs > li:not(.active) > a {
  border-color: transparent;
  background-color: transparent;
}
.widget-toolbar > .nav-tabs > li:not(.active) > a:hover {
  background-color: transparent;
}
.widget-toolbar > .nav-tabs > li.active > a {
  background-color: #FFF;
  border-bottom-color: transparent;
  box-shadow: none;
  margin-top: auto;
}
.widget-header-small > .widget-toolbar > .nav-tabs > li > a {
  line-height: 16px;
  padding-top: 6px;
  padding-bottom: 6px;
}
.widget-header-small > .widget-toolbar > .nav-tabs > li.active > a {
  border-top-width: 2px;
}
.widget-header-large > .widget-toolbar > .nav-tabs > li > a {
  line-height: 22px;
  padding-top: 9px;
  padding-bottom: 9px;
  margin-top: 4px;
}
.widget-header-large > .widget-toolbar > .nav-tabs > li.active > a {
  margin-top: 3px;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li > a {
  border-color: transparent;
  background-color: transparent;
  color: #FFF;
  margin-right: 1px;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li > a:hover {
  background-color: #FFF;
  color: #555;
  border-top-color: #FFF;
}
[class*="widget-color-"] > .widget-header > .widget-toolbar > .nav-tabs > li.active > a {
  background-color: #FFF;
  color: #555;
  border-top-width: 1px;
  margin-top: 0;
}
.widget-toolbar > .nav-tabs .widget-color-orange > .widget-header > li > a {
  color: #855D10;
}
.transparent > .widget-header > .widget-toolbar > .nav-tabs > li > a {
  color: #555;
  background-color: transparent;
  border-right: 1px solid transparent;
  border-left: 1px solid transparent;
}
.transparent > .widget-header > .widget-toolbar > .nav-tabs > li.active > a {
  border-top-color: #4C8FBD;
  border-right: 1px solid #C5D0DC;
  border-left: 1px solid #C5D0DC;
  background-color: #FFF;
  box-shadow: none;
}
.widget-toolbox {
  background-color: #EEE;
}
.widget-toolbox:first-child {
  padding: 2px;
  border-bottom: 1px solid #CCC;
}
.widget-toolbox:last-child {
  padding: 2px;
  border-top: 1px solid #CCC;
}
.transparent > .widget-body > .widget-toolbox:last-child {
  border: none;
  border-top: 1px solid #CCC;
}
.widget-toolbox > .btn-toolbar {
  margin: 0 !important;
  padding: 0;
}
.widget-toolbox.center {
  text-align: center;
}
.widget-toolbox.padding-16 {
  padding: 16px;
}
.widget-toolbox.padding-14 {
  padding: 14px;
}
.widget-toolbox.padding-12 {
  padding: 12px;
}
.widget-toolbox.padding-10 {
  padding: 10px;
}
.widget-toolbox.padding-8 {
  padding: 8px;
}
.widget-toolbox.padding-6 {
  padding: 6px;
}
.widget-toolbox.padding-4 {
  padding: 4px;
}
.widget-toolbox.padding-2 {
  padding: 2px;
}
.widget-toolbox.padding-0 {
  padding: 0px;
}
.widget-box-overlay {
  position: absolute;
  top: -1px;
  bottom: -1px;
  right: -1px;
  left: -1px;
  z-index: 999;
  text-align: center;
  min-height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
}
.widget-box-overlay > .loading-icon {
  position: relative;
  top: 20%;
  left: 0;
  right: 0;
  text-align: center;
}
.widget-box.collapsed .widget-box-overlay > .loading-icon {
  top: 10%;
}
.widget-box-overlay > .loading-icon.icon-spin {
  -moz-animation-duration: 1.2s;
  -webkit-animation-duration: 1.2s;
  -o-animation-duration: 1.2s;
  -ms-animation-duration: 1.2s;
  animation-duration: 1.2s;
}
.widget-main > form {
  margin-bottom: 0;
}
.widget-main > form .input-append,
.widget-main > form .input-prepend {
  margin-bottom: 0;
}
.widget-main.no-padding > form > fieldset,
.widget-main.padding-0 > form > fieldset {
  padding: 16px;
}
.widget-main.no-padding > form > fieldset + .form-actions,
.widget-main.padding-0 > form > fieldset + .form-actions {
  padding: 10px 0 12px;
}
.widget-main.no-padding > form > .form-actions,
.widget-main.padding-0 > form > .form-actions {
  margin: 0;
  padding: 10px 12px 12px;
}
.widget-placeholder {
  border: 2px dashed #D9D9D9;
}


/*.btn {
  display: inline-block;
  color: #FFF !important;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25) !important;
  background-image: none !important;
  border: 5px solid #FFF;
  border-radius: 0;
  box-shadow: none !important;
  -webkit-transition: background-color 0.15s, border-color 0.15s, opacity 0.15s;
  -o-transition: background-color 0.15s, border-color 0.15s, opacity 0.15s;
  transition: background-color 0.15s, border-color 0.15s, opacity 0.15s;
  cursor: pointer;
  vertical-align: middle;
  margin: 0;
  position: relative;
}
.btn-lg {
  border-width: 5px;
  line-height: 1.35;
  padding: 7px 16px;
}
.btn-sm {
  border-width: 4px;
  font-size: 13px;
  padding: 4px 9px;
  line-height: 1.39;
}
.btn-xs {
  border-width: 3px;
}
.btn-minier {
  padding: 0 4px;
  line-height: 18px;
  border-width: 2px;
  font-size: 12px;
}
button.btn:active {
  top: 1px;
}
.btn,
.btn-default,
.btn:focus,
.btn-default:focus {
  background-color: #abbac3 !important;
  border-color: #abbac3;
}
.btn:hover,
.btn-default:hover,
.btn:active,
.btn-default:active,
.open .btn.dropdown-toggle,
.open .btn-default.dropdown-toggle {
  background-color: #8b9aa3 !important;
  border-color: #abbac3;
}
.btn.no-border:hover,
.btn-default.no-border:hover,
.btn.no-border:active,
.btn-default.no-border:active {
  border-color: #8b9aa3;
}
.btn.no-hover:hover,
.btn-default.no-hover:hover,
.btn.no-hover:active,
.btn-default.no-hover:active {
  background-color: #abbac3 !important;
}
.btn.active,
.btn-default.active {
  background-color: #9baab3 !important;
  border-color: #8799a4;
}
.btn.no-border.active,
.btn-default.no-border.active {
  background-color: #92a3ac !important;
  border-color: #92a3ac;
}
.btn.disabled,
.btn-default.disabled,
.btn[disabled],
.btn-default[disabled],
fieldset[disabled] .btn,
fieldset[disabled] .btn-default,
.btn.disabled:hover,
.btn-default.disabled:hover,
.btn[disabled]:hover,
.btn-default[disabled]:hover,
fieldset[disabled] .btn:hover,
fieldset[disabled] .btn-default:hover,
.btn.disabled:focus,
.btn-default.disabled:focus,
.btn[disabled]:focus,
.btn-default[disabled]:focus,
fieldset[disabled] .btn:focus,
fieldset[disabled] .btn-default:focus,
.btn.disabled:active,
.btn-default.disabled:active,
.btn[disabled]:active,
.btn-default[disabled]:active,
fieldset[disabled] .btn:active,
fieldset[disabled] .btn-default:active,
.btn.disabled.active,
.btn-default.disabled.active,
.btn[disabled].active,
.btn-default[disabled].active,
fieldset[disabled] .btn.active,
fieldset[disabled] .btn-default.active {
  background-color: #abbac3 !important;
  border-color: #abbac3;
}
.btn-primary,
.btn-primary:focus {
  background-color: #428bca !important;
  border-color: #428bca;
}
.btn-primary:hover,
.btn-primary:active,
.open .btn-primary.dropdown-toggle {
  background-color: #1b6aaa !important;
  border-color: #428bca;
}
.btn-primary.no-border:hover,
.btn-primary.no-border:active {
  border-color: #1b6aaa;
}
.btn-primary.no-hover:hover,
.btn-primary.no-hover:active {
  background-color: #428bca !important;
}
.btn-primary.active {
  background-color: #2f7bba !important;
  border-color: #27689d;
}
.btn-primary.no-border.active {
  background-color: #2b72ae !important;
  border-color: #2b72ae;
}
.btn-primary.disabled,
.btn-primary[disabled],
fieldset[disabled] .btn-primary,
.btn-primary.disabled:hover,
.btn-primary[disabled]:hover,
fieldset[disabled] .btn-primary:hover,
.btn-primary.disabled:focus,
.btn-primary[disabled]:focus,
fieldset[disabled] .btn-primary:focus,
.btn-primary.disabled:active,
.btn-primary[disabled]:active,
fieldset[disabled] .btn-primary:active,
.btn-primary.disabled.active,
.btn-primary[disabled].active,
fieldset[disabled] .btn-primary.active {
  background-color: #428bca !important;
  border-color: #428bca;
}
.btn-info,
.btn-info:focus {
  background-color: #6fb3e0 !important;
  border-color: #6fb3e0;
}
.btn-info:hover,
.btn-info:active,
.open .btn-info.dropdown-toggle {
  background-color: #4f99c6 !important;
  border-color: #6fb3e0;
}
.btn-info.no-border:hover,
.btn-info.no-border:active {
  border-color: #4f99c6;
}
.btn-info.no-hover:hover,
.btn-info.no-hover:active {
  background-color: #6fb3e0 !important;
}
.btn-info.active {
  background-color: #5fa6d3 !important;
  border-color: #4396cb;
}
.btn-info.no-border.active {
  background-color: #539fd0 !important;
  border-color: #539fd0;
}
.btn-info.disabled,
.btn-info[disabled],
fieldset[disabled] .btn-info,
.btn-info.disabled:hover,
.btn-info[disabled]:hover,
fieldset[disabled] .btn-info:hover,
.btn-info.disabled:focus,
.btn-info[disabled]:focus,
fieldset[disabled] .btn-info:focus,
.btn-info.disabled:active,
.btn-info[disabled]:active,
fieldset[disabled] .btn-info:active,
.btn-info.disabled.active,
.btn-info[disabled].active,
fieldset[disabled] .btn-info.active {
  background-color: #6fb3e0 !important;
  border-color: #6fb3e0;
}
.btn-info2,
.btn-info2:focus {
  background-color: #95c6e5 !important;
  border-color: #95c6e5;
}
.btn-info2:hover,
.btn-info2:active,
.open .btn-info2.dropdown-toggle {
  background-color: #67a6ce !important;
  border-color: #95c6e5;
}
.btn-info2.no-border:hover,
.btn-info2.no-border:active {
  border-color: #67a6ce;
}
.btn-info2.no-hover:hover,
.btn-info2.no-hover:active {
  background-color: #95c6e5 !important;
}
.btn-info2.active {
  background-color: #7eb6da !important;
  border-color: #62a6d1;
}
.btn-info2.no-border.active {
  background-color: #72afd6 !important;
  border-color: #72afd6;
}
.btn-info2.disabled,
.btn-info2[disabled],
fieldset[disabled] .btn-info2,
.btn-info2.disabled:hover,
.btn-info2[disabled]:hover,
fieldset[disabled] .btn-info2:hover,
.btn-info2.disabled:focus,
.btn-info2[disabled]:focus,
fieldset[disabled] .btn-info2:focus,
.btn-info2.disabled:active,
.btn-info2[disabled]:active,
fieldset[disabled] .btn-info2:active,
.btn-info2.disabled.active,
.btn-info2[disabled].active,
fieldset[disabled] .btn-info2.active {
  background-color: #95c6e5 !important;
  border-color: #95c6e5;
}
.btn-success,
.btn-success:focus {
  background-color: #87b87f !important;
  border-color: #87b87f;
}
.btn-success:hover,
.btn-success:active,
.open .btn-success.dropdown-toggle {
  background-color: #629b58 !important;
  border-color: #87b87f;
}
.btn-success.no-border:hover,
.btn-success.no-border:active {
  border-color: #629b58;
}
.btn-success.no-hover:hover,
.btn-success.no-hover:active {
  background-color: #87b87f !important;
}
.btn-success.active {
  background-color: #75aa6c !important;
  border-color: #629959;
}
.btn-success.no-border.active {
  background-color: #6ba462 !important;
  border-color: #6ba462;
}
.btn-success.disabled,
.btn-success[disabled],
fieldset[disabled] .btn-success,
.btn-success.disabled:hover,
.btn-success[disabled]:hover,
fieldset[disabled] .btn-success:hover,
.btn-success.disabled:focus,
.btn-success[disabled]:focus,
fieldset[disabled] .btn-success:focus,
.btn-success.disabled:active,
.btn-success[disabled]:active,
fieldset[disabled] .btn-success:active,
.btn-success.disabled.active,
.btn-success[disabled].active,
fieldset[disabled] .btn-success.active {
  background-color: #87b87f !important;
  border-color: #87b87f;
}
.btn-warning,
.btn-warning:focus {
  background-color: #ffb752 !important;
  border-color: #ffb752;
}
.btn-warning:hover,
.btn-warning:active,
.open .btn-warning.dropdown-toggle {
  background-color: #e59729 !important;
  border-color: #ffb752;
}
.btn-warning.no-border:hover,
.btn-warning.no-border:active {
  border-color: #e59729;
}
.btn-warning.no-hover:hover,
.btn-warning.no-hover:active {
  background-color: #ffb752 !important;
}
.btn-warning.active {
  background-color: #f2a73e !important;
  border-color: #f0981c;
}
.btn-warning.no-border.active {
  background-color: #f1a02f !important;
  border-color: #f1a02f;
}
.btn-warning.disabled,
.btn-warning[disabled],
fieldset[disabled] .btn-warning,
.btn-warning.disabled:hover,
.btn-warning[disabled]:hover,
fieldset[disabled] .btn-warning:hover,
.btn-warning.disabled:focus,
.btn-warning[disabled]:focus,
fieldset[disabled] .btn-warning:focus,
.btn-warning.disabled:active,
.btn-warning[disabled]:active,
fieldset[disabled] .btn-warning:active,
.btn-warning.disabled.active,
.btn-warning[disabled].active,
fieldset[disabled] .btn-warning.active {
  background-color: #ffb752 !important;
  border-color: #ffb752;
}
.btn-danger,
.btn-danger:focus {
  background-color: #d15b47 !important;
  border-color: #d15b47;
}
.btn-danger:hover,
.btn-danger:active,
.open .btn-danger.dropdown-toggle {
  background-color: #b74635 !important;
  border-color: #d15b47;
}
.btn-danger.no-border:hover,
.btn-danger.no-border:active {
  border-color: #b74635;
}
.btn-danger.no-hover:hover,
.btn-danger.no-hover:active {
  background-color: #d15b47 !important;
}
.btn-danger.active {
  background-color: #c4513e !important;
  border-color: #aa4434;
}
.btn-danger.no-border.active {
  background-color: #ba4b39 !important;
  border-color: #ba4b39;
}
.btn-danger.disabled,
.btn-danger[disabled],
fieldset[disabled] .btn-danger,
.btn-danger.disabled:hover,
.btn-danger[disabled]:hover,
fieldset[disabled] .btn-danger:hover,
.btn-danger.disabled:focus,
.btn-danger[disabled]:focus,
fieldset[disabled] .btn-danger:focus,
.btn-danger.disabled:active,
.btn-danger[disabled]:active,
fieldset[disabled] .btn-danger:active,
.btn-danger.disabled.active,
.btn-danger[disabled].active,
fieldset[disabled] .btn-danger.active {
  background-color: #d15b47 !important;
  border-color: #d15b47;
}
.btn-inverse,
.btn-inverse:focus {
  background-color: #555555 !important;
  border-color: #555555;
}
.btn-inverse:hover,
.btn-inverse:active,
.open .btn-inverse.dropdown-toggle {
  background-color: #303030 !important;
  border-color: #555555;
}
.btn-inverse.no-border:hover,
.btn-inverse.no-border:active {
  border-color: #303030;
}
.btn-inverse.no-hover:hover,
.btn-inverse.no-hover:active {
  background-color: #555555 !important;
}
.btn-inverse.active {
  background-color: #434343 !important;
  border-color: #313131;
}
.btn-inverse.no-border.active {
  background-color: #3b3b3b !important;
  border-color: #3b3b3b;
}
.btn-inverse.disabled,
.btn-inverse[disabled],
fieldset[disabled] .btn-inverse,
.btn-inverse.disabled:hover,
.btn-inverse[disabled]:hover,
fieldset[disabled] .btn-inverse:hover,
.btn-inverse.disabled:focus,
.btn-inverse[disabled]:focus,
fieldset[disabled] .btn-inverse:focus,
.btn-inverse.disabled:active,
.btn-inverse[disabled]:active,
fieldset[disabled] .btn-inverse:active,
.btn-inverse.disabled.active,
.btn-inverse[disabled].active,
fieldset[disabled] .btn-inverse.active {
  background-color: #555555 !important;
  border-color: #555555;
}
.btn-pink,
.btn-pink:focus {
  background-color: #d6487e !important;
  border-color: #d6487e;
}
.btn-pink:hover,
.btn-pink:active,
.open .btn-pink.dropdown-toggle {
  background-color: #b73766 !important;
  border-color: #d6487e;
}
.btn-pink.no-border:hover,
.btn-pink.no-border:active {
  border-color: #b73766;
}
.btn-pink.no-hover:hover,
.btn-pink.no-hover:active {
  background-color: #d6487e !important;
}
.btn-pink.active {
  background-color: #c74072 !important;
  border-color: #af3462;
}
.btn-pink.no-border.active {
  background-color: #be386a !important;
  border-color: #be386a;
}
.btn-pink.disabled,
.btn-pink[disabled],
fieldset[disabled] .btn-pink,
.btn-pink.disabled:hover,
.btn-pink[disabled]:hover,
fieldset[disabled] .btn-pink:hover,
.btn-pink.disabled:focus,
.btn-pink[disabled]:focus,
fieldset[disabled] .btn-pink:focus,
.btn-pink.disabled:active,
.btn-pink[disabled]:active,
fieldset[disabled] .btn-pink:active,
.btn-pink.disabled.active,
.btn-pink[disabled].active,
fieldset[disabled] .btn-pink.active {
  background-color: #d6487e !important;
  border-color: #d6487e;
}
.btn-purple,
.btn-purple:focus {
  background-color: #9585bf !important;
  border-color: #9585bf;
}
.btn-purple:hover,
.btn-purple:active,
.open .btn-purple.dropdown-toggle {
  background-color: #7461aa !important;
  border-color: #9585bf;
}
.btn-purple.no-border:hover,
.btn-purple.no-border:active {
  border-color: #7461aa;
}
.btn-purple.no-hover:hover,
.btn-purple.no-hover:active {
  background-color: #9585bf !important;
}
.btn-purple.active {
  background-color: #8573b5 !important;
  border-color: #705ca8;
}
.btn-purple.no-border.active {
  background-color: #7c69af !important;
  border-color: #7c69af;
}
.btn-purple.disabled,
.btn-purple[disabled],
fieldset[disabled] .btn-purple,
.btn-purple.disabled:hover,
.btn-purple[disabled]:hover,
fieldset[disabled] .btn-purple:hover,
.btn-purple.disabled:focus,
.btn-purple[disabled]:focus,
fieldset[disabled] .btn-purple:focus,
.btn-purple.disabled:active,
.btn-purple[disabled]:active,
fieldset[disabled] .btn-purple:active,
.btn-purple.disabled.active,
.btn-purple[disabled].active,
fieldset[disabled] .btn-purple.active {
  background-color: #9585bf !important;
  border-color: #9585bf;
}
.btn-grey,
.btn-grey:focus {
  background-color: #a0a0a0 !important;
  border-color: #a0a0a0;
}
.btn-grey:hover,
.btn-grey:active,
.open .btn-grey.dropdown-toggle {
  background-color: #888888 !important;
  border-color: #a0a0a0;
}
.btn-grey.no-border:hover,
.btn-grey.no-border:active {
  border-color: #888888;
}
.btn-grey.no-hover:hover,
.btn-grey.no-hover:active {
  background-color: #a0a0a0 !important;
}
.btn-grey.active {
  background-color: #949494 !important;
  border-color: #828282;
}
.btn-grey.no-border.active {
  background-color: #8c8c8c !important;
  border-color: #8c8c8c;
}
.btn-grey.disabled,
.btn-grey[disabled],
fieldset[disabled] .btn-grey,
.btn-grey.disabled:hover,
.btn-grey[disabled]:hover,
fieldset[disabled] .btn-grey:hover,
.btn-grey.disabled:focus,
.btn-grey[disabled]:focus,
fieldset[disabled] .btn-grey:focus,
.btn-grey.disabled:active,
.btn-grey[disabled]:active,
fieldset[disabled] .btn-grey:active,
.btn-grey.disabled.active,
.btn-grey[disabled].active,
fieldset[disabled] .btn-grey.active {
  background-color: #a0a0a0 !important;
  border-color: #a0a0a0;
}
.btn-yellow {
  color: #996633 !important;
  text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.4) !important;
}
.btn-yellow,
.btn-yellow:focus {
  background-color: #fee188 !important;
  border-color: #fee188;
}
.btn-yellow:hover,
.btn-yellow:active,
.open .btn-yellow.dropdown-toggle {
  background-color: #f7d05b !important;
  border-color: #fee188;
}
.btn-yellow.no-border:hover,
.btn-yellow.no-border:active {
  border-color: #f7d05b;
}
.btn-yellow.no-hover:hover,
.btn-yellow.no-hover:active {
  background-color: #fee188 !important;
}
.btn-yellow.active {
  background-color: #fbd972 !important;
  border-color: #f9cf4f;
}
.btn-yellow.no-border.active {
  background-color: #fad463 !important;
  border-color: #fad463;
}
.btn-yellow.disabled,
.btn-yellow[disabled],
fieldset[disabled] .btn-yellow,
.btn-yellow.disabled:hover,
.btn-yellow[disabled]:hover,
fieldset[disabled] .btn-yellow:hover,
.btn-yellow.disabled:focus,
.btn-yellow[disabled]:focus,
fieldset[disabled] .btn-yellow:focus,
.btn-yellow.disabled:active,
.btn-yellow[disabled]:active,
fieldset[disabled] .btn-yellow:active,
.btn-yellow.disabled.active,
.btn-yellow[disabled].active,
fieldset[disabled] .btn-yellow.active {
  background-color: #fee188 !important;
  border-color: #fee188;
}
.btn-light {
  color: #888888 !important;
  text-shadow: 0 -1px 0 rgba(250, 250, 250, 0.25) !important;
}
.btn-light,
.btn-light:focus {
  background-color: #e7e7e7 !important;
  border-color: #e7e7e7;
}
.btn-light:hover,
.btn-light:active,
.open .btn-light.dropdown-toggle {
  background-color: #d9d9d9 !important;
  border-color: #e7e7e7;
}
.btn-light.no-border:hover,
.btn-light.no-border:active {
  border-color: #d9d9d9;
}
.btn-light.no-hover:hover,
.btn-light.no-hover:active {
  background-color: #e7e7e7 !important;
}
.btn-light.active {
  background-color: #e0e0e0 !important;
  border-color: #cecece;
}
.btn-light.no-border.active {
  background-color: #d8d8d8 !important;
  border-color: #d8d8d8;
}
.btn-light.disabled,
.btn-light[disabled],
fieldset[disabled] .btn-light,
.btn-light.disabled:hover,
.btn-light[disabled]:hover,
fieldset[disabled] .btn-light:hover,
.btn-light.disabled:focus,
.btn-light[disabled]:focus,
fieldset[disabled] .btn-light:focus,
.btn-light.disabled:active,
.btn-light[disabled]:active,
fieldset[disabled] .btn-light:active,
.btn-light.disabled.active,
.btn-light[disabled].active,
fieldset[disabled] .btn-light.active {
  background-color: #e7e7e7 !important;
  border-color: #e7e7e7;
}
.btn-light.btn-xs:after {
  left: -2px;
  right: -2px;
  top: -2px;
  bottom: -2px;
}
.btn-light.btn-sm:after {
  left: -4px;
  right: -4px;
  top: -4px;
  bottom: -4px;
}
.btn-light .btn-lg:after {
  left: -6px;
  right: -6px;
  top: -6px;
  bottom: -6px;
}
.btn.btn-white {
  text-shadow: none !important;
  background-color: #FFF !important;
}
.btn.btn-white.no-hover:hover,
.btn.btn-white.no-hover:active {
  background-color: #FFF !important;
}
.btn.btn-white:focus,
.btn.btn-white.active {
  box-shadow: inset 1px 1px 2px 0 rgba(0, 0, 0, 0.1) !important;
}
.btn.btn-white:focus.btn-bold,
.btn.btn-white.active.btn-bold {
  box-shadow: inset 1px 1px 3px 0 rgba(0, 0, 0, 0.15) !important;
}
.btn.btn-white.active:after {
  display: none;
}
.btn.btn-white {
  border-color: #cccccc;
  color: #444444 !important;
}
.btn.btn-white:hover,
.btn.btn-white:focus,
.btn.btn-white.active,
.btn.btn-white:active,
.open .btn.btn-white.dropdown-toggle {
  background-color: #ebebeb !important;
  border-color: #cccccc;
}
.btn.btn-white:hover {
  color: #3a3434 !important;
}
.btn.btn-white.no-border:hover,
.btn.btn-white.no-border:active {
  border-color: #cccccc;
}
.btn.btn-white.disabled,
.btn.btn-white[disabled],
fieldset[disabled] .btn.btn-white,
.btn.btn-white.disabled:hover,
.btn.btn-white[disabled]:hover,
fieldset[disabled] .btn.btn-white:hover,
.btn.btn-white.disabled:focus,
.btn.btn-white[disabled]:focus,
fieldset[disabled] .btn.btn-white:focus,
.btn.btn-white.disabled:active,
.btn.btn-white[disabled]:active,
fieldset[disabled] .btn.btn-white:active,
.btn.btn-white.disabled.active,
.btn.btn-white[disabled].active,
fieldset[disabled] .btn.btn-white.active {
  border-color: #cccccc;
}
.btn-white.btn-default {
  border-color: #abbac3;
  color: #80909a !important;
}
.btn-white.btn-default:hover,
.btn-white.btn-default:focus,
.btn-white.btn-default.active,
.btn-white.btn-default:active,
.open .btn-white.btn-default.dropdown-toggle {
  background-color: #eff2f4 !important;
  border-color: #abbac3;
}
.btn-white.btn-default:hover {
  color: #6b8595 !important;
}
.btn-white.btn-default.no-border:hover,
.btn-white.btn-default.no-border:active {
  border-color: #abbac3;
}
.btn-white.btn-default.disabled,
.btn-white.btn-default[disabled],
fieldset[disabled] .btn-white.btn-default,
.btn-white.btn-default.disabled:hover,
.btn-white.btn-default[disabled]:hover,
fieldset[disabled] .btn-white.btn-default:hover,
.btn-white.btn-default.disabled:focus,
.btn-white.btn-default[disabled]:focus,
fieldset[disabled] .btn-white.btn-default:focus,
.btn-white.btn-default.disabled:active,
.btn-white.btn-default[disabled]:active,
fieldset[disabled] .btn-white.btn-default:active,
.btn-white.btn-default.disabled.active,
.btn-white.btn-default[disabled].active,
fieldset[disabled] .btn-white.btn-default.active {
  border-color: #abbac3;
}
.btn-white.btn-primary {
  border-color: #8aafce;
  color: #6688a6 !important;
}
.btn-white.btn-primary:hover,
.btn-white.btn-primary:focus,
.btn-white.btn-primary.active,
.btn-white.btn-primary:active,
.open .btn-white.btn-primary.dropdown-toggle {
  background-color: #eaf2f8 !important;
  border-color: #8aafce;
}
.btn-white.btn-primary:hover {
  color: #537c9f !important;
}
.btn-white.btn-primary.no-border:hover,
.btn-white.btn-primary.no-border:active {
  border-color: #8aafce;
}
.btn-white.btn-primary.disabled,
.btn-white.btn-primary[disabled],
fieldset[disabled] .btn-white.btn-primary,
.btn-white.btn-primary.disabled:hover,
.btn-white.btn-primary[disabled]:hover,
fieldset[disabled] .btn-white.btn-primary:hover,
.btn-white.btn-primary.disabled:focus,
.btn-white.btn-primary[disabled]:focus,
fieldset[disabled] .btn-white.btn-primary:focus,
.btn-white.btn-primary.disabled:active,
.btn-white.btn-primary[disabled]:active,
fieldset[disabled] .btn-white.btn-primary:active,
.btn-white.btn-primary.disabled.active,
.btn-white.btn-primary[disabled].active,
fieldset[disabled] .btn-white.btn-primary.active {
  border-color: #8aafce;
}
.btn-white.btn-success {
  border-color: #a7c9a1;
  color: #81a87b !important;
}
.btn-white.btn-success:hover,
.btn-white.btn-success:focus,
.btn-white.btn-success.active,
.btn-white.btn-success:active,
.open .btn-white.btn-success.dropdown-toggle {
  background-color: #edf4eb !important;
  border-color: #a7c9a1;
}
.btn-white.btn-success:hover {
  color: #6ea465 !important;
}
.btn-white.btn-success.no-border:hover,
.btn-white.btn-success.no-border:active {
  border-color: #a7c9a1;
}
.btn-white.btn-success.disabled,
.btn-white.btn-success[disabled],
fieldset[disabled] .btn-white.btn-success,
.btn-white.btn-success.disabled:hover,
.btn-white.btn-success[disabled]:hover,
fieldset[disabled] .btn-white.btn-success:hover,
.btn-white.btn-success.disabled:focus,
.btn-white.btn-success[disabled]:focus,
fieldset[disabled] .btn-white.btn-success:focus,
.btn-white.btn-success.disabled:active,
.btn-white.btn-success[disabled]:active,
fieldset[disabled] .btn-white.btn-success:active,
.btn-white.btn-success.disabled.active,
.btn-white.btn-success[disabled].active,
fieldset[disabled] .btn-white.btn-success.active {
  border-color: #a7c9a1;
}
.btn-white.btn-danger {
  border-color: #d7a59d;
  color: #b7837a !important;
}
.btn-white.btn-danger:hover,
.btn-white.btn-danger:focus,
.btn-white.btn-danger.active,
.btn-white.btn-danger:active,
.open .btn-white.btn-danger.dropdown-toggle {
  background-color: #fbf4f3 !important;
  border-color: #d7a59d;
}
.btn-white.btn-danger:hover {
  color: #b46f64 !important;
}
.btn-white.btn-danger.no-border:hover,
.btn-white.btn-danger.no-border:active {
  border-color: #d7a59d;
}
.btn-white.btn-danger.disabled,
.btn-white.btn-danger[disabled],
fieldset[disabled] .btn-white.btn-danger,
.btn-white.btn-danger.disabled:hover,
.btn-white.btn-danger[disabled]:hover,
fieldset[disabled] .btn-white.btn-danger:hover,
.btn-white.btn-danger.disabled:focus,
.btn-white.btn-danger[disabled]:focus,
fieldset[disabled] .btn-white.btn-danger:focus,
.btn-white.btn-danger.disabled:active,
.btn-white.btn-danger[disabled]:active,
fieldset[disabled] .btn-white.btn-danger:active,
.btn-white.btn-danger.disabled.active,
.btn-white.btn-danger[disabled].active,
fieldset[disabled] .btn-white.btn-danger.active {
  border-color: #d7a59d;
}
.btn-white.btn-warning {
  border-color: #e7b979;
  color: #daa458 !important;
}
.btn-white.btn-warning:hover,
.btn-white.btn-warning:focus,
.btn-white.btn-warning.active,
.btn-white.btn-warning:active,
.open .btn-white.btn-warning.dropdown-toggle {
  background-color: #fef7ec !important;
  border-color: #e7b979;
}
.btn-white.btn-warning:hover {
  color: #db9a3d !important;
}
.btn-white.btn-warning.no-border:hover,
.btn-white.btn-warning.no-border:active {
  border-color: #e7b979;
}
.btn-white.btn-warning.disabled,
.btn-white.btn-warning[disabled],
fieldset[disabled] .btn-white.btn-warning,
.btn-white.btn-warning.disabled:hover,
.btn-white.btn-warning[disabled]:hover,
fieldset[disabled] .btn-white.btn-warning:hover,
.btn-white.btn-warning.disabled:focus,
.btn-white.btn-warning[disabled]:focus,
fieldset[disabled] .btn-white.btn-warning:focus,
.btn-white.btn-warning.disabled:active,
.btn-white.btn-warning[disabled]:active,
fieldset[disabled] .btn-white.btn-warning:active,
.btn-white.btn-warning.disabled.active,
.btn-white.btn-warning[disabled].active,
fieldset[disabled] .btn-white.btn-warning.active {
  border-color: #e7b979;
}
.btn-white.btn-info {
  border-color: #8fbcd9;
  color: #70a0c1 !important;
}
.btn-white.btn-info:hover,
.btn-white.btn-info:focus,
.btn-white.btn-info.active,
.btn-white.btn-info:active,
.open .btn-white.btn-info.dropdown-toggle {
  background-color: #eef5fa !important;
  border-color: #8fbcd9;
}
.btn-white.btn-info:hover {
  color: #5896bf !important;
}
.btn-white.btn-info.no-border:hover,
.btn-white.btn-info.no-border:active {
  border-color: #8fbcd9;
}
.btn-white.btn-info.disabled,
.btn-white.btn-info[disabled],
fieldset[disabled] .btn-white.btn-info,
.btn-white.btn-info.disabled:hover,
.btn-white.btn-info[disabled]:hover,
fieldset[disabled] .btn-white.btn-info:hover,
.btn-white.btn-info.disabled:focus,
.btn-white.btn-info[disabled]:focus,
fieldset[disabled] .btn-white.btn-info:focus,
.btn-white.btn-info.disabled:active,
.btn-white.btn-info[disabled]:active,
fieldset[disabled] .btn-white.btn-info:active,
.btn-white.btn-info.disabled.active,
.btn-white.btn-info[disabled].active,
fieldset[disabled] .btn-white.btn-info.active {
  border-color: #8fbcd9;
}
.btn-white.btn-inverse {
  border-color: #959595;
  color: #555555 !important;
}
.btn-white.btn-inverse:hover,
.btn-white.btn-inverse:focus,
.btn-white.btn-inverse.active,
.btn-white.btn-inverse:active,
.open .btn-white.btn-inverse.dropdown-toggle {
  background-color: #e4e4e4 !important;
  border-color: #959595;
}
.btn-white.btn-inverse:hover {
  color: #4c4545 !important;
}
.btn-white.btn-inverse.no-border:hover,
.btn-white.btn-inverse.no-border:active {
  border-color: #959595;
}
.btn-white.btn-inverse.disabled,
.btn-white.btn-inverse[disabled],
fieldset[disabled] .btn-white.btn-inverse,
.btn-white.btn-inverse.disabled:hover,
.btn-white.btn-inverse[disabled]:hover,
fieldset[disabled] .btn-white.btn-inverse:hover,
.btn-white.btn-inverse.disabled:focus,
.btn-white.btn-inverse[disabled]:focus,
fieldset[disabled] .btn-white.btn-inverse:focus,
.btn-white.btn-inverse.disabled:active,
.btn-white.btn-inverse[disabled]:active,
fieldset[disabled] .btn-white.btn-inverse:active,
.btn-white.btn-inverse.disabled.active,
.btn-white.btn-inverse[disabled].active,
fieldset[disabled] .btn-white.btn-inverse.active {
  border-color: #959595;
}
.btn-white.btn-pink {
  border-color: #d299ae;
  color: #af6f87 !important;
}
.btn-white.btn-pink:hover,
.btn-white.btn-pink:focus,
.btn-white.btn-pink.active,
.btn-white.btn-pink:active,
.open .btn-white.btn-pink.dropdown-toggle {
  background-color: #fbeff4 !important;
  border-color: #d299ae;
}
.btn-white.btn-pink:hover {
  color: #ac5978 !important;
}
.btn-white.btn-pink.no-border:hover,
.btn-white.btn-pink.no-border:active {
  border-color: #d299ae;
}
.btn-white.btn-pink.disabled,
.btn-white.btn-pink[disabled],
fieldset[disabled] .btn-white.btn-pink,
.btn-white.btn-pink.disabled:hover,
.btn-white.btn-pink[disabled]:hover,
fieldset[disabled] .btn-white.btn-pink:hover,
.btn-white.btn-pink.disabled:focus,
.btn-white.btn-pink[disabled]:focus,
fieldset[disabled] .btn-white.btn-pink:focus,
.btn-white.btn-pink.disabled:active,
.btn-white.btn-pink[disabled]:active,
fieldset[disabled] .btn-white.btn-pink:active,
.btn-white.btn-pink.disabled.active,
.btn-white.btn-pink[disabled].active,
fieldset[disabled] .btn-white.btn-pink.active {
  border-color: #d299ae;
}
.btn-white.btn-purple {
  border-color: #b7b1c6;
  color: #7d6fa2 !important;
}
.btn-white.btn-purple:hover,
.btn-white.btn-purple:focus,
.btn-white.btn-purple.active,
.btn-white.btn-purple:active,
.open .btn-white.btn-purple.dropdown-toggle {
  background-color: #efedf5 !important;
  border-color: #b7b1c6;
}
.btn-white.btn-purple:hover {
  color: #6d5b9c !important;
}
.btn-white.btn-purple.no-border:hover,
.btn-white.btn-purple.no-border:active {
  border-color: #b7b1c6;
}
.btn-white.btn-purple.disabled,
.btn-white.btn-purple[disabled],
fieldset[disabled] .btn-white.btn-purple,
.btn-white.btn-purple.disabled:hover,
.btn-white.btn-purple[disabled]:hover,
fieldset[disabled] .btn-white.btn-purple:hover,
.btn-white.btn-purple.disabled:focus,
.btn-white.btn-purple[disabled]:focus,
fieldset[disabled] .btn-white.btn-purple:focus,
.btn-white.btn-purple.disabled:active,
.btn-white.btn-purple[disabled]:active,
fieldset[disabled] .btn-white.btn-purple:active,
.btn-white.btn-purple.disabled.active,
.btn-white.btn-purple[disabled].active,
fieldset[disabled] .btn-white.btn-purple.active {
  border-color: #b7b1c6;
}
.btn-white.btn-yellow {
  border-color: #ecd181;
  color: #d3a61a !important;
}
.btn-white.btn-yellow:hover,
.btn-white.btn-yellow:focus,
.btn-white.btn-yellow.active,
.btn-white.btn-yellow:active,
.open .btn-white.btn-yellow.dropdown-toggle {
  background-color: #fdf7e4 !important;
  border-color: #ecd181;
}
.btn-white.btn-yellow:hover {
  color: #c29712 !important;
}
.btn-white.btn-yellow.no-border:hover,
.btn-white.btn-yellow.no-border:active {
  border-color: #ecd181;
}
.btn-white.btn-yellow.disabled,
.btn-white.btn-yellow[disabled],
fieldset[disabled] .btn-white.btn-yellow,
.btn-white.btn-yellow.disabled:hover,
.btn-white.btn-yellow[disabled]:hover,
fieldset[disabled] .btn-white.btn-yellow:hover,
.btn-white.btn-yellow.disabled:focus,
.btn-white.btn-yellow[disabled]:focus,
fieldset[disabled] .btn-white.btn-yellow:focus,
.btn-white.btn-yellow.disabled:active,
.btn-white.btn-yellow[disabled]:active,
fieldset[disabled] .btn-white.btn-yellow:active,
.btn-white.btn-yellow.disabled.active,
.btn-white.btn-yellow[disabled].active,
fieldset[disabled] .btn-white.btn-yellow.active {
  border-color: #ecd181;
}
.btn-white.btn-grey {
  border-color: #c6c6c6;
  color: #8c8c8c !important;
}
.btn-white.btn-grey:hover,
.btn-white.btn-grey:focus,
.btn-white.btn-grey.active,
.btn-white.btn-grey:active,
.open .btn-white.btn-grey.dropdown-toggle {
  background-color: #ededed !important;
  border-color: #c6c6c6;
}
.btn-white.btn-grey:hover {
  color: #857979 !important;
}
.btn-white.btn-grey.no-border:hover,
.btn-white.btn-grey.no-border:active {
  border-color: #c6c6c6;
}
.btn-white.btn-grey.disabled,
.btn-white.btn-grey[disabled],
fieldset[disabled] .btn-white.btn-grey,
.btn-white.btn-grey.disabled:hover,
.btn-white.btn-grey[disabled]:hover,
fieldset[disabled] .btn-white.btn-grey:hover,
.btn-white.btn-grey.disabled:focus,
.btn-white.btn-grey[disabled]:focus,
fieldset[disabled] .btn-white.btn-grey:focus,
.btn-white.btn-grey.disabled:active,
.btn-white.btn-grey[disabled]:active,
fieldset[disabled] .btn-white.btn-grey:active,
.btn-white.btn-grey.disabled.active,
.btn-white.btn-grey[disabled].active,
fieldset[disabled] .btn-white.btn-grey.active {
  border-color: #c6c6c6;
}
.btn.disabled.active,
.btn[disabled].active,
.btn.disabled:focus,
.btn[disabled]:focus,
.btn.disabled:active,
.btn[disabled]:active {
  outline: none;
}
.btn.disabled:active,
.btn[disabled]:active {
  top: 0;
  left: 0;
}
.btn.active {
  color: #efe5b5;
}
.btn.active:after {
  display: inline-block;
  content: "";
  position: absolute;
  border-bottom: 1px solid #efe5b5;
  left: -4px;
  right: -4px;
  bottom: -4px;
}
.btn.active.btn-sm:after {
  left: -3px;
  right: -3px;
  bottom: -3px;
}
.btn.active.btn-lg:after {
  left: -5px;
  right: -5px;
  bottom: -5px;
}
.btn.active.btn-xs:after,
.btn.active.btn-minier:after {
  left: -1px;
  right: -1px;
  bottom: -2px;
}
.btn.active.btn-minier:after {
  bottom: -1px;
}
.btn.active.btn-yellow:after {
  border-bottom-color: #c96338;
}
.btn.active.btn-light {
  color: #515151;
}
.btn.active.btn-light:after {
  border-bottom-color: #B5B5B5;
}
.btn > .ace-icon {
  margin-right: 4px;
}
.btn > .ace-icon.icon-on-right {
  margin-right: 0;
  margin-left: 4px;
}
.btn > .icon-only.ace-icon {
  margin: 0 !important;
  text-align: center;
  padding: 0;
}
.btn-large > .ace-icon {
  margin-right: 6px;
}
.btn-large > .ace-icon.icon-on-right {
  margin-right: 0;
  margin-left: 6px;
}
.btn-sm > .ace-icon {
  margin: 2px;
}
.btn-sm > .ace-icon.icon-on-right {
 
  margin: 2px;
}
.btn-xs > .ace-icon,
.btn-minier > .ace-icon {
  margin-right: 2px;
}
.btn-xs > .ace-icon.icon-on-right,
.btn-minier > .ace-icon.icon-on-right {
  margin-right: 0;
  margin-left: 2px;
}
.btn.btn-link {
  border: none !important;
  background: transparent none !important;
  color: #0088cc !important;
  text-shadow: none !important;
  padding: 4px 12px !important;
  line-height: 20px !important;
}
.btn.btn-link:hover {
  background: none !important;
  text-shadow: none !important;
}
.btn.btn-link.active {
  background: none !important;
  text-decoration: underline;
  color: #009ceb !important;
}
.btn.btn-link.active:after {
  display: none;
}
.btn.btn-link.disabled,
.btn.btn-link[disabled] {
  background: transparent none !important;
  opacity: 0.65;
  filter: alpha(opacity=65);
  text-decoration: none !important;
}
.btn.btn-no-border {
  border-width: 0 !important;
}
.btn-group:first-child {
  margin-left: 0;
}
.btn-group > .btn,
.btn-group > .btn + .btn {
  margin: 0 1px 0 0;
}
.btn-group > .btn:first-child {
  margin: 0 1px 0 0;
}
.btn-group > .btn > .caret {
  margin-top: 15px;
  margin-left: 1px;
  border-width: 5px;
  border-top-color: #FFF;
}
.btn-group > .btn.btn-sm > .caret {
  margin-top: 10px;
  border-width: 4px;
}
.btn-group > .btn.btn-large > .caret {
  margin-top: 18px;
  border-width: 6px;
}
.btn-group > .btn.btn-xs > .caret {
  margin-top: 9px;
  border-width: 4px;
}
.btn-group > .btn.btn-minier > .caret {
  margin-top: 7px;
  border-width: 3px;
}
.btn-group > .btn + .btn.dropdown-toggle {
  padding-right: 3px;
  padding-left: 3px;
}
.btn-group > .btn + .btn-large.dropdown-toggle {
  padding-right: 4px;
  padding-left: 4px;
}
.btn-group .dropdown-toggle {
  border-radius: 0;
}
.btn-group > .btn,
.btn-group + .btn {
  margin: 0 1px 0 0;
  border-width: 3px;
  /* the border under an active button in button groups */
}
.btn-group > .btn.active:after,
.btn-group + .btn.active:after {
  left: -2px;
  right: -2px;
  bottom: -2px;
  border-bottom-width: 1px;
}
.btn-group > .btn-large,
.btn-group + .btn-large {
  border-width: 4px;
  /* the border under an active button in button groups */
}
.btn-group > .btn-large.active:after,
.btn-group + .btn-large.active:after {
  left: -3px;
  right: -3px;
  bottom: -3px;
  border-bottom-width: 1px;
}
.btn-group > .btn-sm,
.btn-group + .btn-sm {
  border-width: 2px;
  /* the border under an active button in button groups */
}
.btn-group > .btn-sm.active:after,
.btn-group + .btn-sm.active:after {
  left: -1px;
  right: -1px;
  bottom: -1px;
  border-bottom-width: 1px;
}
.btn-group > .btn-xs,
.btn-group + .btn-xs {
  border-width: 1px;
  /* the border under an active button in button groups */
}
.btn-group > .btn-xs.active:after,
.btn-group + .btn-xs.active:after {
  left: 0px;
  right: 0px;
  bottom: 0px;
  border-bottom-width: 1px;
}
.btn-group > .btn-minier,
.btn-group + .btn-minier {
  border-width: 1px;
  /* the border under an active button in button groups */
}
.btn-group > .btn-minier.active:after,
.btn-group + .btn-minier.active:after {
  left: 0px;
  right: 0px;
  bottom: 0px;
  border-bottom-width: 1px;
}
.btn-group-vertical > .btn:last-child:not(:first-child) {
  border-radius: 0;
}
.btn-group > .btn.btn-round {
  border-radius: 4px;
}
.btn-group-vertical > .btn,
.btn-group-vertical > .btn + .btn {
  margin: 1px 0 0 !important;
}
.btn-group-vertical > .btn:first-child {
  margin-top: 0 !important;
}
.btn-group.btn-overlap > .btn {
  margin-right: -1px;
}
.btn-group.btn-corner > .btn:first-child {
  border-bottom-left-radius: 8px;
  border-top-left-radius: 8px;
}
.btn-group.btn-corner > .btn:last-child {
  border-bottom-right-radius: 8px;
  border-top-right-radius: 8px;
}
.btn-group.btn-corner > .btn.btn-sm:first-child {
  border-bottom-left-radius: 6px;
  border-top-left-radius: 6px;
}
.btn-group.btn-corner > .btn.btn-sm:last-child {
  border-bottom-right-radius: 6px;
  border-top-right-radius: 6px;
}
.btn-group.btn-corner > .btn.btn-xs:first-child {
  border-bottom-left-radius: 4px;
  border-top-left-radius: 4px;
}
.btn-group.btn-corner > .btn.btn-xs:last-child {
  border-bottom-right-radius: 4px;
  border-top-right-radius: 4px;
}
.btn.btn-white {
  border-width: 1px;
}
.btn.btn-bold {
  border-bottom-width: 2px;
}
.btn.btn-round {
  border-bottom-width: 2px;
  border-radius: 4px !important;
}
.btn.btn-app {
  display: inline-block;
  width: 100px;
  font-size: 18px;
  font-weight: normal;
  color: #FFF;
  text-align: center;
  text-shadow: 0 -1px -1px rgba(0, 0, 0, 0.2) !important;
  border: none;
  border-radius: 12px;
  padding: 12px 0 8px;
  margin: 2px;
  line-height: 1.7;
  position: relative;
}
.btn-app,
.btn-app.btn-default,
.btn-app.no-hover:hover,
.btn-app.btn-default.no-hover:hover,
.btn-app.disabled:hover,
.btn-app.btn-default.disabled:hover {
  background: #b4c2cc !important;
  background-image: -webkit-linear-gradient(top, #bcc9d5 0%, #abbac3 100%) !important;
  background-image: -o-linear-gradient(top, #bcc9d5 0%, #abbac3 100%) !important;
  background-image: linear-gradient(to bottom, #bcc9d5 0%, #abbac3 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffbcc9d5', endColorstr='#ffabbac3', GradientType=0) !important;
}
.btn-app:hover,
.btn-app.btn-default:hover {
  background: #9baebc !important;
  background-image: -webkit-linear-gradient(top, #a3b5c5 0%, #93a6b2 100%) !important;
  background-image: -o-linear-gradient(top, #a3b5c5 0%, #93a6b2 100%) !important;
  background-image: linear-gradient(to bottom, #a3b5c5 0%, #93a6b2 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffa3b5c5', endColorstr='#ff93a6b2', GradientType=0) !important;
}
.btn-app.btn-primary,
.btn-app.btn-primary.no-hover:hover,
.btn-app.btn-primary.disabled:hover {
  background: #2a8bcb !important;
  background-image: -webkit-linear-gradient(top, #3b98d6 0%, #197ec1 100%) !important;
  background-image: -o-linear-gradient(top, #3b98d6 0%, #197ec1 100%) !important;
  background-image: linear-gradient(to bottom, #3b98d6 0%, #197ec1 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b98d6', endColorstr='#ff197ec1', GradientType=0) !important;
}
.btn-app.btn-primary:hover {
  background: #1d6fa6 !important;
  background-image: -webkit-linear-gradient(top, #267eb8 0%, #136194 100%) !important;
  background-image: -o-linear-gradient(top, #267eb8 0%, #136194 100%) !important;
  background-image: linear-gradient(to bottom, #267eb8 0%, #136194 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff267eb8', endColorstr='#ff136194', GradientType=0) !important;
}
.btn-app.btn-info,
.btn-app.btn-info.no-hover:hover,
.btn-app.btn-info.disabled:hover {
  background: #68adde !important;
  background-image: -webkit-linear-gradient(top, #75b5e6 0%, #5ba4d5 100%) !important;
  background-image: -o-linear-gradient(top, #75b5e6 0%, #5ba4d5 100%) !important;
  background-image: linear-gradient(to bottom, #75b5e6 0%, #5ba4d5 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff75b5e6', endColorstr='#ff5ba4d5', GradientType=0) !important;
}
.btn-app.btn-info:hover {
  background: #3f96d4 !important;
  background-image: -webkit-linear-gradient(top, #4a9ede 0%, #348dc9 100%) !important;
  background-image: -o-linear-gradient(top, #4a9ede 0%, #348dc9 100%) !important;
  background-image: linear-gradient(to bottom, #4a9ede 0%, #348dc9 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff4a9ede', endColorstr='#ff348dc9', GradientType=0) !important;
}
.btn-app.btn-success,
.btn-app.btn-success.no-hover:hover,
.btn-app.btn-success.disabled:hover {
  background: #85b558 !important;
  background-image: -webkit-linear-gradient(top, #8ebf60 0%, #7daa50 100%) !important;
  background-image: -o-linear-gradient(top, #8ebf60 0%, #7daa50 100%) !important;
  background-image: linear-gradient(to bottom, #8ebf60 0%, #7daa50 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8ebf60', endColorstr='#ff7daa50', GradientType=0) !important;
}
.btn-app.btn-success:hover {
  background: #6c9842 !important;
  background-image: -webkit-linear-gradient(top, #74a844 0%, #648740 100%) !important;
  background-image: -o-linear-gradient(top, #74a844 0%, #648740 100%) !important;
  background-image: linear-gradient(to bottom, #74a844 0%, #648740 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff74a844', endColorstr='#ff648740', GradientType=0) !important;
}
.btn-app.btn-danger,
.btn-app.btn-danger.no-hover:hover,
.btn-app.btn-danger.disabled:hover {
  background: #d3413b !important;
  background-image: -webkit-linear-gradient(top, #d55b52 0%, #d12723 100%) !important;
  background-image: -o-linear-gradient(top, #d55b52 0%, #d12723 100%) !important;
  background-image: linear-gradient(to bottom, #d55b52 0%, #d12723 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd55b52', endColorstr='#ffd12723', GradientType=0) !important;
}
.btn-app.btn-danger:hover {
  background: #b52c26 !important;
  background-image: -webkit-linear-gradient(top, #c43a30 0%, #a51f1c 100%) !important;
  background-image: -o-linear-gradient(top, #c43a30 0%, #a51f1c 100%) !important;
  background-image: linear-gradient(to bottom, #c43a30 0%, #a51f1c 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc43a30', endColorstr='#ffa51f1c', GradientType=0) !important;
}
.btn-app.btn-warning,
.btn-app.btn-warning.no-hover:hover,
.btn-app.btn-warning.disabled:hover {
  background: #ffb44b !important;
  background-image: -webkit-linear-gradient(top, #ffbf66 0%, #ffa830 100%) !important;
  background-image: -o-linear-gradient(top, #ffbf66 0%, #ffa830 100%) !important;
  background-image: linear-gradient(to bottom, #ffbf66 0%, #ffa830 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffbf66', endColorstr='#ffffa830', GradientType=0) !important;
}
.btn-app.btn-warning:hover {
  background: #fe9e19 !important;
  background-image: -webkit-linear-gradient(top, #ffaa33 0%, #fc9200 100%) !important;
  background-image: -o-linear-gradient(top, #ffaa33 0%, #fc9200 100%) !important;
  background-image: linear-gradient(to bottom, #ffaa33 0%, #fc9200 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffaa33', endColorstr='#fffc9200', GradientType=0) !important;
}
.btn-app.btn-purple,
.btn-app.btn-purple.no-hover:hover,
.btn-app.btn-purple.disabled:hover {
  background: #9889c1 !important;
  background-image: -webkit-linear-gradient(top, #a696ce 0%, #8a7cb4 100%) !important;
  background-image: -o-linear-gradient(top, #a696ce 0%, #8a7cb4 100%) !important;
  background-image: linear-gradient(to bottom, #a696ce 0%, #8a7cb4 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffa696ce', endColorstr='#ff8a7cb4', GradientType=0) !important;
}
.btn-app.btn-purple:hover {
  background: #7b68af !important;
  background-image: -webkit-linear-gradient(top, #8973be 0%, #6d5ca1 100%) !important;
  background-image: -o-linear-gradient(top, #8973be 0%, #6d5ca1 100%) !important;
  background-image: linear-gradient(to bottom, #8973be 0%, #6d5ca1 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8973be', endColorstr='#ff6d5ca1', GradientType=0) !important;
}
.btn-app.btn-pink,
.btn-app.btn-pink.no-hover:hover,
.btn-app.btn-pink.disabled:hover {
  background: #d54c7e !important;
  background-image: -webkit-linear-gradient(top, #db5e8c 0%, #ce3970 100%) !important;
  background-image: -o-linear-gradient(top, #db5e8c 0%, #ce3970 100%) !important;
  background-image: linear-gradient(to bottom, #db5e8c 0%, #ce3970 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdb5e8c', endColorstr='#ffce3970', GradientType=0) !important;
}
.btn-app.btn-pink:hover {
  background: #be2f64 !important;
  background-image: -webkit-linear-gradient(top, #d2346e 0%, #aa2a59 100%) !important;
  background-image: -o-linear-gradient(top, #d2346e 0%, #aa2a59 100%) !important;
  background-image: linear-gradient(to bottom, #d2346e 0%, #aa2a59 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd2346e', endColorstr='#ffaa2a59', GradientType=0) !important;
}
.btn-app.btn-inverse,
.btn-app.btn-inverse.no-hover:hover,
.btn-app.btn-inverse.disabled:hover {
  background: #444444 !important;
  background-image: -webkit-linear-gradient(top, #555555 0%, #333333 100%) !important;
  background-image: -o-linear-gradient(top, #555555 0%, #333333 100%) !important;
  background-image: linear-gradient(to bottom, #555555 0%, #333333 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff555555', endColorstr='#ff333333', GradientType=0) !important;
}
.btn-app.btn-inverse:hover {
  background: #2b2b2b !important;
  background-image: -webkit-linear-gradient(top, #3b3b3b 0%, #1a1a1a 100%) !important;
  background-image: -o-linear-gradient(top, #3b3b3b 0%, #1a1a1a 100%) !important;
  background-image: linear-gradient(to bottom, #3b3b3b 0%, #1a1a1a 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff3b3b3b', endColorstr='#ff1a1a1a', GradientType=0) !important;
}
.btn-app.btn-grey,
.btn-app.btn-grey.no-hover:hover,
.btn-app.btn-grey.disabled:hover {
  background: #797979 !important;
  background-image: -webkit-linear-gradient(top, #898989 0%, #696969 100%) !important;
  background-image: -o-linear-gradient(top, #898989 0%, #696969 100%) !important;
  background-image: linear-gradient(to bottom, #898989 0%, #696969 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff898989', endColorstr='#ff696969', GradientType=0) !important;
}
.btn-app.btn-grey:hover {
  background: #6c6c6c !important;
  background-image: -webkit-linear-gradient(top, #7c7c7c 0%, #5c5c5c 100%) !important;
  background-image: -o-linear-gradient(top, #7c7c7c 0%, #5c5c5c 100%) !important;
  background-image: linear-gradient(to bottom, #7c7c7c 0%, #5c5c5c 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff7c7c7c', endColorstr='#ff5c5c5c', GradientType=0) !important;
}
.btn.btn-app.btn-light {
  color: #5a5a5a !important;
  text-shadow: 0 1px 1px #EEE !important;
}
.btn.btn-app.btn-light,
.btn.btn-app.btn-light.no-hover:hover,
.btn.btn-app.btn-light.disabled:hover {
  background: #ededed !important;
  background-image: -webkit-linear-gradient(top, #f4f4f4 0%, #e6e6e6 100%) !important;
  background-image: -o-linear-gradient(top, #f4f4f4 0%, #e6e6e6 100%) !important;
  background-image: linear-gradient(to bottom, #f4f4f4 0%, #e6e6e6 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff4f4f4', endColorstr='#ffe6e6e6', GradientType=0) !important;
}
.btn.btn-app.btn-light:hover {
  background: #e0e0e0 !important;
  background-image: -webkit-linear-gradient(top, #e7e7e7 0%, #d9d9d9 100%) !important;
  background-image: -o-linear-gradient(top, #e7e7e7 0%, #d9d9d9 100%) !important;
  background-image: linear-gradient(to bottom, #e7e7e7 0%, #d9d9d9 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffe7e7e7', endColorstr='#ffd9d9d9', GradientType=0) !important;
}
.btn.btn-app.btn-yellow {
  color: #996633 !important;
  text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.4) !important;
}
.btn.btn-app.btn-yellow,
.btn.btn-app.btn-yellow.no-hover:hover,
.btn.btn-app.btn-yellow.disabled:hover {
  background: #fee088 !important;
  background-image: -webkit-linear-gradient(top, #ffe8a5 0%, #fcd76a 100%) !important;
  background-image: -o-linear-gradient(top, #ffe8a5 0%, #fcd76a 100%) !important;
  background-image: linear-gradient(to bottom, #ffe8a5 0%, #fcd76a 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffe8a5', endColorstr='#fffcd76a', GradientType=0) !important;
}
.btn.btn-app.btn-yellow:hover {
  background: #fdd96e !important;
  background-image: -webkit-linear-gradient(top, #ffe18b 0%, #fbd051 100%) !important;
  background-image: -o-linear-gradient(top, #ffe18b 0%, #fbd051 100%) !important;
  background-image: linear-gradient(to bottom, #ffe18b 0%, #fbd051 100%) !important;
  background-repeat: repeat-x !important;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffe18b', endColorstr='#fffbd051', GradientType=0) !important;
}
.btn.btn-app > .ace-icon {
  opacity: 0.88;
}
.btn.btn-app:hover > .ace-icon {
  opacity: 1;
}
.btn.btn-app.btn-sm {
  width: 80px;
  font-size: 16px;
  border-radius: 10px;
  line-height: 1.5;
}
.btn.btn-app.btn-xs {
  width: 64px;
  font-size: 15px;
  border-radius: 8px;
  padding-bottom: 7px;
  padding-top: 8px;
  line-height: 1.45;
}
.btn.btn-app > .ace-icon {
  display: block;
  font-size: 42px;
  margin: 0 0 4px;
  line-height: 36px;
  min-width: 0;
  padding: 0;
}
.btn.btn-app.btn-sm > .ace-icon {
  display: block;
  font-size: 32px;
  line-height: 30px;
  margin: 0 0 3px;
}
.btn.btn-app.btn-xs > .ace-icon {
  display: block;
  font-size: 24px;
  line-height: 24px;
  margin: 0;
}
.btn.btn-app.no-radius {
  border-radius: 0;
}
.btn.btn-app.radius-4 {
  border-radius: 4px;
}
.btn.btn-app > .badge,
.btn.btn-app > .label {
  position: absolute !important;
  top: -2px;
  right: -2px;
  padding: 1px 3px;
  text-align: center;
  font-size: 12px;
  color: #FFF;
}
.btn.btn-app > .badge.badge-left,
.btn.btn-app > .label.badge-left,
.btn.btn-app > .badge.label-left,
.btn.btn-app > .label.label-left {
  right: auto;
  left: -2px;
}
.btn.btn-app > .label {
  padding: 1px 6px 3px;
  font-size: 13px;
}
.btn.btn-app.radius-4 > .badge,
.btn.btn-app.no-radius > .badge {
  border-radius: 3px;
}
.btn.btn-app.radius-4 > .badge.no-radius,
.btn.btn-app.no-radius > .badge.no-radius {
  border-radius: 0;
}
.btn.btn-app.active {
  color: #ffffff;
}
.btn.btn-app.active:after {
  display: none;
}
.btn.btn-app.active.btn-yellow {
  color: #996633;
  border-color: #fee188;
}
.btn.btn-app.active.btn-light {
  color: #515151;
}
.btn-group > .btn-app:first-child:not(:last-child):not(.dropdown-toggle) {
  margin-right: 24px;
}
.btn-group > .btn-app + .btn-app.dropdown-toggle {
  position: absolute;
  width: auto;
  height: 100%;
  padding-left: 6px;
  padding-right: 6px;
  margin-left: -23px;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  right: 0;
}
.btn.btn-app.btn-light,
.btn.btn-app.btn-yellow {
  -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08) inset !important;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08) inset !important;
}*/




.modal-content {
  border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.modal-footer {
  padding-top: 12px;
  padding-bottom: 14px;
  border-top-color: #e4e9ee;
  -webkit-box-shadow: none;
  box-shadow: none;
  background-color: #eff3f8;
}
.modal-header .close {
  font-size: 32px;
}
.modal.aside-dark .modal-content {
  background-color: rgba(0, 0, 0, 0.85);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#D8000000', endColorstr='#D8000000',GradientType=0 );
}
.modal.aside {
  z-index: 999;
  position: absolute;
}
.navbar-fixed-top ~ .modal.aside-vc {
  z-index: 1025;
}
.modal.aside-fixed.aside-hz,
.navbar-fixed-top ~ .modal.aside-hz,
.navbar-fixed-bottom ~ .modal.aside-hz {
  position: fixed;
  z-index: 1039;
}
.modal.aside-fixed.aside-vc {
  position: fixed;
}
.modal.aside.in {
  z-index: 1040;
  position: fixed;
}
.modal.aside-vc {
  margin: auto;
  width: 0;
  left: auto;
  right: auto;
  top: 0;
  bottom: 0;
  display: block !important;
  overflow: visible;
}
.modal.in.aside-vc {
  width: 100%;
}
.modal.aside-vc .modal-dialog {
  margin: inherit;
  overflow: inherit;
  width: 250px;
  max-width: 66%;
  height: inherit;
  position: inherit;
  right: inherit;
  top: inherit;
  bottom: inherit;
  left: inherit;
  opacity: 1;
  transition: transform 0.3s ease-out 0s;
  -webkit-transition: -webkit-transform 0.3s ease-out 0s;
}
@media only screen and (max-width: 319px) {
  .modal.aside-vc .modal-dialog {
    max-width: none;
    width: 200px;
  }
}
@media only screen and (max-width: 240px) {
  .modal.aside-vc .modal-dialog {
    max-width: none;
    width: 160px;
  }
}
.modal.aside-vc .modal-content {
  height: 100%;
  overflow: hidden;
}
.modal.in.aside-vc .modal-dialog {
  transform: translate3d(0px, 0px, 0px);
  -webkit-transform: translate3d(0px, 0px, 0px);
  height: auto;
}
.modal.aside-vc .aside-trigger {
  position: absolute;
  top: 155px;
  right: auto;
  left: auto;
  bottom: auto;
  margin-top: -1px;
  width: 37px;
  outline: none;
}
.modal.aside-vc .aside-trigger.ace-settings-btn {
  width: 42px;
}
.modal.in.aside-vc .aside-trigger {
  z-index: -1;
}
@media only screen and (max-height: 240px) {
  .modal.aside-vc .aside-trigger {
    top: 130px;
  }
}
.modal.aside-vc.navbar-offset .modal-dialog {
  top: 45px;
}
.modal.aside-vc.navbar-offset .modal-dialog .aside-trigger {
  top: 110px;
}
@media (max-width: 479px) {
  .navbar:not(.navbar-collapse) ~ .modal.aside-vc.navbar-offset .modal-dialog {
    top: 90px;
  }
}
.modal.aside-right {
  right: 0;
}
.modal.aside-right .modal-content {
  border-width: 0 0 0 1px;
  box-shadow: -2px 1px 2px 0 rgba(0, 0, 0, 0.15);
}
.modal.aside-right .aside-trigger {
  right: 100%;
}
.modal.aside-right .modal-dialog {
  transform: translate3d(100%, 0px, 0px);
  -webkit-transform: translate3d(100%, 0px, 0px);
}
.modal.aside-left {
  left: 0;
}
.modal.aside-left .modal-content {
  border-width: 0 1px 0 0;
  box-shadow: 2px -1px 2px 0 rgba(0, 0, 0, 0.15);
}
.modal.aside-left .aside-trigger {
  left: 100%;
}
.modal.aside-right .aside-trigger.btn.ace-settings-btn {
  border-radius: 6px 0 0 6px;
}
.modal.aside-left .aside-trigger.btn.ace-settings-btn {
  border-radius: 0 6px 6px 0;
}
.modal.aside-left .modal-dialog {
  transform: translate3d(-100%, 0px, 0px);
  -webkit-transform: translate3d(-100%, 0px, 0px);
}
.modal.aside-hz {
  margin: auto;
  height: 0;
  left: 0;
  right: 0;
  top: auto;
  bottom: auto;
  display: block !important;
  overflow: visible;
}
.modal.in.aside-hz {
  height: 100%;
}
.modal.aside-hz .modal-dialog {
  margin: inherit;
  height: auto;
  overflow: inherit;
  max-height: 50%;
  width: inherit;
  position: inherit;
  right: inherit;
  top: inherit;
  bottom: inherit;
  left: inherit;
  opacity: 1;
  transition: transform 0.3s ease-out 0s;
  -webkit-transition: -webkit-transform 0.3s ease-out 0s;
}
@media only screen and (max-height: 320px) {
  .modal.aside-hz .modal-dialog {
    max-height: 66%;
  }
}
.modal.aside-hz .modal-content {
  width: 100%;
  overflow: hidden;
}
.modal.in.aside-hz .modal-dialog {
  transform: translate3d(0px, 0px, 0px);
  -webkit-transform: translate3d(0px, 0px, 0px);
  height: auto;
}
.modal.aside-hz .aside-trigger {
  position: absolute;
  top: auto;
  right: auto;
  bottom: auto;
  margin-top: -1px;
  z-index: auto;
  outline: none;
  margin-left: -15px;
  left: 50%;
}
.modal.aside-hz .aside-trigger.ace-settings-btn {
  margin-left: -20px;
}
.modal.in.aside-hz .aside-trigger {
  z-index: -1;
}
.modal.aside-top {
  top: 0;
}
.modal.aside-top .modal-dialog {
  transform: translate3d(0px, -100%, 0px);
  -webkit-transform: translate3d(0px, -100%, 0px);
}
.modal.aside-top .modal-content {
  border-width: 0;
  box-shadow: 1px 2px 2px 0 rgba(0, 0, 0, 0.15);
}
.modal.aside-bottom {
  bottom: 0;
}
.modal.aside-bottom .modal-dialog {
  transform: translate3d(0px, 100%, 0px);
  -webkit-transform: translate3d(0px, 100%, 0px);
}
.modal.aside-bottom .modal-content {
  border-width: 0;
  box-shadow: -1px 2px 2px 0 rgba(0, 0, 0, 0.15);
}
.modal.aside-bottom .aside-trigger {
  bottom: 100%;
  margin-top: auto;
  margin-bottom: -1px;
}
.modal.aside-top .aside-trigger.ace-settings-btn {
  border-radius: 0 0 6px 6px !important;
}
.modal.aside-bottom .aside-trigger.ace-settings-btn {
  border-radius: 6px 6px 0 0 !important;
}
.aside.aside-hidden .modal-content {
  display: none;
}
@media only screen and (min-width: 768px) {
  .container.main-container ~ .modal.aside-vc .modal-dialog {
    transition: none;
    -webkit-transition: none;
  }
  .container.main-container ~ .modal.aside-vc:not(.in) .modal-content {
    display: none;
  }
}
.modal.in.no-backdrop {
  height: auto;
  width: auto;
}
.modal.aside-hz .aside-trigger.align-left {
  left: 15px;
  margin-left: auto;
  text-align: center;
}
.modal.aside-hz .aside-trigger.align-right {
  text-align: center;
  left: auto;
  margin-left: auto;
  right: 15px;
}
.modal.transition-off .modal-dialog {
  transition: none;
  -webkit-transition: none;
}

.button_height{
	height:25px;
}



.boxe{
	margin:4px, 4px; 
                padding:4px; 
                width: 780px; 
                height: 110px; 
                overflow-y: scroll;
                text-align:justify;
}
</style>



			<div class="row-fluid">

				<div class="span12">
				
					<div class="span9">
					
					<div class="box">
						<div class="title">

							<h4>
								 <span><?=lang($action."_title");?>
								</span>
							</h4>

						</div>
					
						<div class="content">
							<div class="form-row row-fluid">
							<div class="form-actions">
								<h3><?=lang('lead_info')?></h3>
							</div>
							</div>
							
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->companys_name)){?>
								<p><?= ucwords($result->companys_name); ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('industry_type')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->industry_name)){?>
								<p><?= ucwords($result->industry_name); ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>  
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->company_address)){?>
								<p><?= ucwords($result->company_address); ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('type_of_establishment')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(isset($client_type_establishment) && is_array($client_type_establishment)){
                                                foreach($client_type_establishment as $i_key => $i_val){
													if($result->type_of_establishment == $i_val->form_id){
														echo $i_val->name;
                                               } } ?>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('country')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->country_name)){?>
								<p><?= ucwords($result->country_name); ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('city_code')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->city_code)){?>
								<p><?= ucwords($result->city_code); ?></p>
                              <?php }else { ?>
							  <p>-/-</p>
							  <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('state')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->state_name)){?>
								<p><?= ucwords($result->state_name); ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('landline')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->landline)){?>
								<p><?= $result->landline ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('city')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->city_name)){?>
								<p><?= ucwords($result->city_name); ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('type_of_client')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(isset($type_of_client) && is_array($type_of_client)){
                                                foreach($type_of_client as $i_key => $i_val){
													if($result->type_of_client == $i_val->form_id){ ?>
														<p><?=$i_val->name;?></p>
                                               <?php } } ?>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('pincode')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->pincode)){?>
								<p><?= $result->pincode; ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('plant_established_year')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->plant_established_year)){?>
								<p><?= $result->plant_established_year ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('cordinates')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->cordinates)){?>
								<p><?=$result->cordinates; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('website_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->website)){?>
								<p><?= $result->website ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
							
							
							
						<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('tax_info')?></h3>
					</div>
				</div>	
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('pan')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tax_pan)){?>
								<p><?= $result->tax_pan; ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('cin')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tax_cin)){?>
								<p><?= $result->tax_cin ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('gst')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tax_gst)){?>
								<p><?=$result->tax_gst; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('tan')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tax_tan)){?>
								<p><?= $result->tax_tan ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				
				
				
				
							
					<!--------------------End tax fields Here -------------------->	
				
				
				
				
				<!------------ contact Info-->
				
				<!--<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('contact_info')?></h3>
					</div>
				</div>
				
						
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->primary_phone)){?>
								<p><?= $result->primary_phone; ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_email_company')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->email_id)){?>
								<p><?= $result->email_id ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->contact_person_name)){?>
								<p><?= $result->contact_person_name ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                   <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_previous_company')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->previous_company)){?>
								<p><?= $result->previous_company; ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                </div>
					
				
				<div class="form-row row-fluid">
					  <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_department')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->department_name)){?>
								<p><?= $result->department_name ?></p>
                               <?php }else { ?>
							    <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_personal_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->secondary_phone)){?>
								<p><?=$result->secondary_phone; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_designation')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->designation_name)){?>
								<p><?=$result->designation_name; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_email')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->personal_email)){?>
								<p><?= $result->personal_email ?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_other_info')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->notes)){?>
								<p><?=$result->notes; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_current_company_status')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->company_status)){?>
								<p><?php   if($result->company_status=='current'){ echo "Working"; }
																	if($result->company_status=='left'){ echo "Left"; }
															?></p>
                               <?php }else { ?>
							   <p>-/-</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>-->
				
				
				<!---------------------End Here Contact Information---------------------->
				
				
				<!------------ Common data Info-->
				
				<?php if(!empty($result->companys_name)) { ?>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('common_data_info')?></h3>
					</div>
				</div>
				
				<?php foreach($result->lead_sales_pcb_common_plc as $key_varient_plc=>$val_varient_plc){  ;?>
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('plc_dcs_make')?><em>*</em></label>
						<div class="row-fluid">
						<div class="span6 select_style_margin-left">
							 <?php if(isset($plc_dcs_make) && is_array($plc_dcs_make)){
                              foreach($plc_dcs_make as $i_key => $i_val){
								  if($val_varient_plc->plc_dcs_make == $i_val->form_id){
                              ?>
							<?php if(!empty($i_val->name)){?>
								<p><?=$i_val->name; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 <?php } } } ?>
						</div>
						<p class="help-block"></p>
						</div>
															 
					</div>
														
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('plc_dcs_qty')?></label>
							 <div class="row-fluid">
								<div class="span6 input-bottom-5">  
								  <?php if(!empty($val_varient_plc->plc_dcs_qty)){?>
								<p><?=$val_varient_plc->plc_dcs_qty; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 </div>
							 <p class="help-block"></p>
						   </div>
						</div>
					</div>
				</div>
				<?php } ?>						
				<?php foreach($result->lead_sales_pcb_common_actuator as $key_varient_actuator=>$val_varient_actuator){  ;?>
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('actuator_make')?><em>*</em></label>
						<div class="row-fluid">
						<div class="span6 select_style_margin-left">
							<?php if(isset($actuator_make) && is_array($actuator_make)){
                              foreach($actuator_make as $i_key => $i_val){
								  if($val_varient_actuator->actuator_make == $i_val->form_id){
                              ?>
							<?php if(!empty($i_val->name)){?>
								<p><?=$i_val->name; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 <?php } } } ?>
						</div>
						<p class="help-block"></p>
						</div>
															 
					</div>
														
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('actuator_qty')?></label>
							 <div class="row-fluid">
								<div class="span6 input-bottom-5">
								 <?php if(!empty($val_varient_actuator->actuator_qty)){?>
								<p><?=$val_varient_actuator->actuator_qty; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 </div>
							 <p class="help-block"></p>
						   </div>
						</div>
					</div>
				</div>
				<?php } ?>						
				
			<!----------------- VFD BLOCK START HEREE  --------------->	
				<?php foreach($result->lead_sales_pcb_common_vfd as $key_varient_vfd=>$val_varient_vfd){  ?>
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('vfd_make')?><em>*</em></label>
						<div class="row-fluid">
						<div class="span6 select_style_margin-left">
							<?php if(isset($vfd_make) && is_array($vfd_make)){
                              foreach($vfd_make as $i_key => $i_val){
							  if($val_varient_vfd->vfd_make == $i_val->form_id){
                              ?>
							<?php if(!empty($i_val->name)){?>
								<p><?=$i_val->name; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 <?php } } } ?>
						</div>
						<p class="help-block"></p>
						</div>
															 
					</div>
														
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vfd_qty')?></label>
							 <div class="row-fluid">
								<div class="span6 input-bottom-5">  
								  <?php if(!empty($val_varient_vfd->vfd_qty)){?>
								<p><?=$val_varient_vfd->vfd_qty; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
							 </div>
							 <p class="help-block"></p>
						   </div>
						</div>
					</div>
				</div>
				<?php } }?>	
				
				
				<!------------Documents Show----------->
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('documents')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
				<?php foreach ($result->leads_service_automation_doc as $leads_service_automation_doc_key => $leads_service_automation_doc_value) { ?>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_upload')?></label>
							 <div class="row-fluid">
								<div class="span6 "> 
								<?php if(!empty($leads_service_automation_doc_value->filename)){ ?>
								<p><?= ucwords($leads_service_automation_doc_value->filename); ?>
								<?php 
										if(isset($result->leads_service_automation_doc) && !empty($result->leads_service_automation_doc))
										{
											
												$ext = $val->filename;
												$ext = substr($ext, strripos($ext, '.')+1);
												if($ext=='jpg' || $ext=='jpeg' || $ext == 'png')
												{ ?>
													<a download href="<?=base_url('upload/service_automation/'.$leads_service_automation_doc_value->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('upload/service_automation/'.$leads_service_automation_doc_value->filename)?>"/></a>

												<?php } else{?>
													<a download href="<?=base_url('upload/service_automation/'.$leads_service_automation_doc_value->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('assets/images/file_icon.png')?>"/></a>
												<?php }
											
										}  
								?></p>
								<?php   }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						
							 </div>
						   </div>
						</div>
					</div>
				<?php } ?>
				</div>
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('doc_notes')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
				<?php if(!empty($note)){ ?>
                    <div class="span12">
						<div class="row-fluid" >
							
							<div class="boxe">
							<?php if(isset($note) && is_array($note)){
							foreach($note as $i_key => $i_val){ ?>
								<p style="float:left"><b><?=ucwords($i_val->note)?></b></p><br>
								<p style="float:left">____________________________________________________________________________________________________________________________________________</p><br>
							<?php } }  ?>
							</div>
							</div>
						</div>
					<?php } ?>
				</div>	
				
				
				
				
				<!-- ####### for Lead OTHERS  ###################-->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('form_information')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vendor_code')?><em>*</em></label>
							<div class="row-fluid">
								<div class="span6">
								<?php if(!empty($result->vendor_code)){?>
								<p><?=$result->vendor_code; ?></p>
                                <?php }else { ?>
								<p>-/-</p>
								 <?php } ?>
								</div>
							</div>
						</div>	
					</div>
				</div>
				
				
                        <!--<div class="row">    
							<div class="col-xs-12">-->
							<!-------------------------------------Notification------------------------------------->
                           
                            <!-------------------------------------------------------------------------------------->
								<!--<div  class="user-profile">-->
										<!--<div class="space-12"></div>-->
											<?php //pr($result);die; ?>
											<!--<div class="row">-->
                                            <!--<div class="col-sm-8">
											<div class="profile-user-info profile-user-info-striped">-->
												
                                          
                                               	
                                               
                                                
												
												
												
												
												
												
											
						</div><!--content-->
					</div><!--box-->
				</div><!--span8-->
										<div class="span3">
											<!------------------------------Actions------------------------------------>
												<div class="row-fluid">
												  <div class="span12">
													<div class="widget-box widget-color-blue">
														<div class="widget-header widget-header-small">
															<h5 class="widget-title bigger lighter">
																<i class="ace-icon fa fa-table"></i>
																Action
															</h5>
														</div>
														<div class="widget-body">
															<div class="widget-main">
																<div class="row-fluid">
																	<div class="span12"  style="width:205px;">
																		<?php //pr($leads_ids); //if($leadStatus=='2' || $leadStatus=='0'){?>
																		<!--<p>
																			<a class="btn btn-sm btn-success equal-width button_height" href="<?=base_url()?>qualified_lead/service_automation/edit/<?=@$leads_ids;?>"><i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i> Edit</a>
																		</p>-->
																		<?php //} ?>
																		<?php //if($module_name=='lead' && $leadStatus==0){?> 
																		<p>
																		<!--<button type="button" class="btn btn-info btn-sm equal-width button_height" data-toggle="modal" data-target="#myModal" style="box-sizing: content-box;" ><i class="ace-icon fa fa-share"></i> Qualified Sales Spares </button>-->
																		</p>
																		<?php //} ?>
																		<?php //if($module_name=='lead' && $leadStatus==0){?>
																		<p>
																		<a href="#" data-toggle="modal" data-target="#diqualifiedModal" class="btn btn-danger btn-sm equal-width button_height"><i class="ace-icon fa fa-reply"></i> Disqualified Sales Spares</a>
																		</p>
																		<?php //} ?>
																		<p>	  
																	   <?php //if($module_name=='opportunity' && $leadStatus==2 && !_isSalesPerson()){?>
																	   <button type="button" class="btn  btn-info btn-sm equal-width button_height" data-toggle="modal" data-target="#assignOppModal" style="box-sizing: content-box;" ><i class="ace-icon fa fa-reply"></i> Assign Opportunity </button>
																	   <?php //} ?>
																	   </p>
																	   <?php //if($module_name=='opportunity' && $assignData && $leadStatus==2){
																		   $var = strtolower($this->uri->segment(2));
																			
																		   $this->session->set_userdata("module_key",$var);
																		   //pr($da);die;
																		   ?>
																	   <p>
																		  <a class="btn btn-danger  btn-sm equal-width button_height" href="<?=base_url()?>opportunity/appointment/<?=$result->main_id;?>"><i class="ace-icon fa fa-calendar"></i> Set Notifications </a>
																	   </p>
																	   <?php //} ?>
																	   <?php //if($module_name=='opportunity' && $assignData && $leadStatus==2){?>
																	   <p>
																		  <a class="btn btn-info  btn-sm equal-width button_height" data-toggle="modal" data-target="#productModal" onclick="addProduct();"><i class="fa fa-plus"></i> Add Product</a>
																	   </p>
																	   <?php //} ?> 
																	   <?php //if($module_name=='opportunity' && $assignData && $leadStatus==2){?>
																	   <p>
																		  <a class="btn btn-danger  btn-sm equal-width button_height" data-toggle="modal" data-target="#serviceModal" onclick="addService();"><i class="fa fa-plus"></i> Add Service</a>
																	   </p>
																	   <?php //} ?>
																	   <?php //if($module_name=='opportunity' && $assignData && $leadStatus==2){?>
																	   <p>
																		  <!--<a class="btn btn-info  btn-sm equal-width button_height" href="#"><i class="ace-icon glyphicon glyphicon-plus"></i> Add Task</a>-->
																	   </p> 
																	   <?php //} ?>
																	   <?php //if($module_name=='opportunity' && $assignData && $leadStatus==2){?> 
																	   <p>
																		  <!--<a class="btn btn-danger  btn-sm equal-width button_height" data-toggle="modal" data-target="#statusModal"><i class="ace-icon fa fa-lightbulb-o"></i> Change Status</a>-->
																	   </p>
																	   <?php //} ?> 
																	   
																		<?php //if($module_name=='opportunity' && $assignData && $leadStatus==3){?> 
																	   <p>
																		  <!--<a class="btn btn-info  btn-sm equal-width button_height" data-toggle="modal" data-target="#statusModal_opportunity"><i class="ace-icon fa fa-lightbulb-o"></i> Mark Billed</a>-->
																	   </p>
																	   <?php //} ?> 
																		<?php //if($module_name=='opportunity' && $assignData && $leadStatus==6){?> 
																	   <p>
																		  <!--<a class="btn btn-danger  btn-sm equal-width button_height" data-toggle="modal" data-target="#statuscompelete_opportunity"><i class="ace-icon fa fa-lightbulb-o"></i> Mark compelete</a>-->
																	   </p>
																	   <?php //} ?> 
																	   <?php /*if($module_name=='opportunity'){ 
																				$reminder_from = 'OR';
																			}else{
																				$reminder_from = 'LR';
																			}*/
																		?> 
																	   <p>
																		  <!--<a class="btn btn-info  btn-sm equal-width button_height" href="#"><i class="ace-icon fa fa-lightbulb-o"></i> Add Reminder</a>-->
																	   </p>
																	</div>
																</div>
															</div>
														</div>
													 </div>
												</div>
											 </div>
												   
												
												
												<!-----Call a common set notification file ------------------->
												<?php 
												$this->load->view('set_notification');
												?>
												<!--------------------------------------------------------------->
												
												
												
												<!---------------------Add Qualified Sales Spares------------------------->
												<?php $main = strtolower($this->uri->segment(2)); ?>
															<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Qualified Sales Spares</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("qualified_lead/$main/qualified_form",array('class'=>'form-horizontal','role'=>'form','id'=>'qualified_form'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <textarea  name="qualified_reason" id="qualified_form"  class="ckeditor"></textarea>
																		   </div>   
																		   
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Qualified Sales Spares</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		<?php echo form_close();?>
																	 </div>
																  </div>       

																  </div>
																</div>
															  </div>
															</div>
															<!------------------------------------------> 

														<!---------------------Add Disqualified Sales Spares------------------------->
															<div class="modal fade" id="diqualifiedModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Disqualified Sales Spares</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("qualified_lead/$main/disqualified_form",array('class'=>'form-horizontal','role'=>'form','id'=>'disqualified_form'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <textarea  name="disqualified_reason" id="disqualified_form"  class="ckeditor"></textarea>
																		   </div>   
																		   
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Disqualified Sales Spares</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		<?php echo form_close();?> 
																	 </div>
																  </div>       

																  </div>
																</div>
															  </div>
															</div>
															<!------------------------------------------> 

															<!---------------------Add Product------------------------->
															<div class="modal fade" id="productModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Add Product</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("qualified_lead/$main/addproduct",array('class'=>'form-horizontal','role'=>'form','id'=>'addproduct'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <textarea  name="product" id="addproduct"  class="ckeditor"><?=@$result->product;?></textarea>
																		   </div>   
																		   
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Add Product</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		<?php echo form_close();?> 
																	 </div>
																  </div>       

																  </div>
																</div>
															  </div>
															</div>
															<!------------------------------------------> 

															<!---------------------Add Service------------------------->
															<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Add Service</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("qualified_lead/$main/addservice",array('class'=>'form-horizontal','role'=>'form','id'=>'addservice'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <textarea  name="service" id="addservice"  class="ckeditor"><?=@$result->service;?></textarea>
																		   </div>   
																		   
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Add Service</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		<?php echo form_close();?> 
																	 </div>
																  </div>       
																</div>
															</div>
														</div>
													 </div>
												</div>
											 <div class="center" style="margin-top:30px">
																			<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
												</div>
											</div>
										</div>
                                 	        
                                 	        
                                            
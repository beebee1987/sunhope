<div class="container">
	<div class="text-center row">
		<h1>OUTLETS</h1>
		<p>Please click on map to choose outlets by state:</p>
	</div>
</div>


<div class="text-center row">
	<div class="container">		
		<div class="col-lg-3 col-md-3">		
			<?php foreach($states as $state):?>
				<p><a href="<?php echo base_url('outlets/'.str_replace(' ', '-', $state['name']))?>"><?php echo $state['name']?></a></p>		
			<?php endforeach;?>					
		</div>
		
		<div class="col-lg-9 col-md-9">
			<!--div class="outletlist">
				<table width="630" cellpadding="0" cellspacing="0">
				    <colgroup><col width="64" span="3">
				    </colgroup><tbody><tr>
				      <td width="723"><img src="http://14.102.150.149/~thunderm/images/map-malaysia.jpg" width="630" height="435" usemap="#Map" border="0">
				        <map name="Map" id="Map">
				          <area shape="poly" coords="148,190,144,202,144,207,142,218,141,224,150,230,154,232,160,234,170,238,180,242,180,252,194,246,202,245,208,241,210,246,218,248,219,241,212,227,206,217,200,207,197,202,190,198,191,204,186,204,179,200,174,201,168,203,163,198,152,195,145,190" href="/~thunderm/outlets/johor" target="_parent" alt="Johor" class="tooltips" onmouseover="tooltip.show('Johor');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="141,206,140,215,138,220,136,222,129,217,124,214,120,210,116,208,122,204,129,203,137,205" href="/~thunderm/outlets/malacca" target="_parent" alt="Malacca" class="tooltips" onmouseover="tooltip.show('Malacca');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="114,187,107,188,106,195,103,200,109,203,111,206,118,205,126,201,135,201,142,203,143,198,143,192,144,188,142,186,136,182,132,178,126,178,119,176,116,175,115,175,115,186" href="/~thunderm/outlets/negeri-sembilan" target="_parent" alt="Negeri Sembilan" class="tooltips" onmouseover="tooltip.show('Negeri Sembilan');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="54,102,49,101,44,102,50,109,53,117,54,124,53,132,59,138,59,146,68,148,73,150,76,152,85,155,88,153,94,153,100,150,97,139,89,130,88,126,89,123,87,118,88,113,91,107,91,100,95,93,98,91,101,88,105,85,103,82,101,76,102,71,101,68,93,65,85,72,79,77,77,77,74,74,72,81,71,87,64,90,59,96,57,98" href="/~thunderm/outlets/perak" target="_parent" alt="Perak" class="tooltips" onmouseover="tooltip.show('Perak');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="42,51,37,57,43,64,43,71,41,78,46,81,52,82,51,90,52,97,55,98,58,92,61,90,69,85,69,78,72,73,72,71,75,67,77,65,75,61,78,57,74,53,68,54,65,53,64,46,60,44,54,45,52,45,47,45,44,50" href="/~thunderm/outlets/kedah" target="_parent" alt="Kedah" class="tooltips" onmouseover="tooltip.show('Kedah');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="44,83,50,86,49,94,45,99,44,94,43,87,43,84" href="/~thunderm/outlets/penang" target="_parent" alt="Penang" class="tooltips" onmouseover="tooltip.show('Penang');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="38,87,36,92,38,94,41,92,40,89" href="/~thunderm/outlets/penang" target="_parent" alt="Penang" class="tooltips" onmouseover="tooltip.show('Penang');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="22,47,22,42,18,46,14,47,15,51,18,51,21,51,22,48" href="#" target="_parent" alt="Perlis" class="tooltips" onmouseover="tooltip.show('Perlis');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="100,122,100,123,93,121,92,126,95,132,99,135,100,141,103,147,108,154,111,160,112,169,127,173,135,177,145,181,154,189,161,195,170,199,178,198,184,198,189,198,190,192,187,190,183,183,185,171,184,161,180,151,180,145,181,138,178,137,174,144,174,147,169,141,163,138,160,138,158,135,160,130,162,127,160,124,156,123,155,117,150,114,146,113,141,116,136,115,134,115,131,120,128,117,124,114,121,112,118,116,116,116,110,113,107,116,103,119,100,121" href="/~thunderm/outlets/pahang" target="_parent" alt="Pahang" class="tooltips" onmouseover="tooltip.show('Pahang');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="105,71,110,71,112,68,112,65,117,62,120,58,123,55,131,57,136,63,138,68,141,70,134,74,134,78,134,84,135,92,137,96,139,101,141,107,142,109,144,111,141,114,135,114,131,116,129,117,123,114,119,112,118,115,113,113,109,114,97,121,93,119,87,117,90,114,93,109,92,105,93,98,96,94,101,91,105,89,106,86,104,82,103,75,102,69" href="/~thunderm/outlets/kelantan" target="_parent" alt="Kelantan" class="tooltips" onmouseover="tooltip.show('Kelantan');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="142,70,138,76,136,80,136,86,139,95,141,102,145,107,146,110,148,112,153,114,158,117,154,121,158,123,160,125,161,130,160,134,164,138,169,139,172,143,176,135,180,135,183,129,181,117,179,110,177,104,173,98,168,90,163,83,154,82,147,74,143,71" alt="Terengganu" class="tooltips" onmouseover="tooltip.show('Terengganu');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="188,319,183,325,186,330,188,336,194,344,199,346,202,349,204,352,208,354,210,354,213,359,217,362,220,362,230,368,240,366,243,363,248,360,254,359,259,358,265,360,278,363,282,360,291,355,296,352,300,345,303,342,312,339,320,339,333,338,336,337,335,341,343,342,347,347,356,349,363,349,371,350,375,347,376,343,389,344,397,342,404,342,409,339,413,329,414,324,416,322,413,310,419,309,426,308,438,300,434,292,431,286,433,284,435,280,443,277,449,271,451,265,454,259,453,252,452,244,455,239,452,234,452,230,450,224,447,220,449,213,453,206,447,203,435,202,429,202,434,208,437,213,435,219,436,225,430,221,427,216,424,208,421,207,417,208,413,212,415,220,418,222,418,226,414,228,412,234,408,237,402,236,398,229,393,225,388,218,385,217,377,217,375,222,376,228,373,232,362,240,356,248,345,259,343,265,337,270,333,276,323,276,301,284,288,284,277,285,269,289,265,295,262,302,261,305,259,306,255,313,255,317,253,320,251,326,251,330,247,335,241,336,240,340,232,338,221,331,220,328,216,329,212,332,208,333,200,330,196,327,190,323,188,319" alt="Sarawak" class="tooltips" onmouseover="tooltip.show('Sarawak');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="444,201" href="#" target="_parent">
				          <area shape="poly" coords="441,201,448,194,444,190,442,185,448,182,461,177,467,172,473,167,474,159,477,152,482,148,486,145,497,132,498,122,504,118,508,128,505,132,507,135,516,127,519,121,528,123,528,130,529,137,534,139,539,136,546,145,546,149,542,154,541,159,540,165,546,162,554,158,557,157,558,161,562,167,553,171,560,171,573,167,592,177,599,182,608,183,615,185,613,195,603,201,581,203,570,203,566,208,576,216,583,221,583,225,568,229,556,231,544,227,542,233,536,236,526,228,519,231,511,232,501,230,492,226,488,231,482,228,475,226,469,229,461,226,460,231,457,233,453,233,453,221,452,210,455,206,454,202,449,199,442,200" alt="Sabah" class="tooltips" onmouseover="tooltip.show('Sabah');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="64,153" href="#" target="_parent">
				          <area shape="poly" coords="65,151,76,155,84,157,87,157,89,155,94,156,100,156,103,156,107,160,107,165,107,168,103,170,96,173,88,178,85,178,76,166,71,160,65,157,65,151" href="/~thunderm/outlets/selangor" target="_parent" alt="Selangor" class="tooltips" onmouseover="tooltip.show('Selangor');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="86,178,87,184,84,188,84,191,89,193,95,197,100,199,103,199,106,190,111,187,115,186,115,174,107,169,89,178" href="/~thunderm/outlets/kuala-lumpur" target="_parent" alt="Kuala Lumpur" class="tooltips" onmouseover="tooltip.show('Kuala Lumpur');" onmouseout="tooltip.hide();">
				          <area shape="poly" coords="389,220,394,227,399,231,401,236,406,237,408,239,413,234,414,232,416,228,419,225,416,220,415,213,419,210,423,208,426,212,428,217,431,221,433,223,436,225,437,219,437,215,436,211,433,207,431,204,431,203,416,207,416,202,411,209,404,214,396,215,389,218,388,219" class="tooltips">
				          <area shape="poly" coords="185,255,192,250,197,249,205,249,208,251,210,255,208,258,203,260,194,257,190,257,185,257,183,255">
				      </map></td>
				    </tr>
				  </tbody>
				  </table>
			</div-->
			<?php if(empty($outlets)){?>
			<div id="wrapper_box">
				<!--img class="responsive-image" src="http://14.102.150.149/~thunderm/images/map-malaysia.jpg" usemap="#Map"-->
				<img src="<?php echo theme_img('malaysia-white.png')?>"  usemap="#Map" border="0">
				 <map name="Map" id="Map">
			          <area shape="poly" coords="429, 487, 384, 402, 378, 386, 364, 389, 367, 401, 339, 389, 324, 395, 284, 372, 271, 403, 270, 422, 271, 426, 265, 438, 277, 451, 290, 454, 299, 462, 307, 465, 346, 479, 345, 494, 356, 500, 380, 486, 391, 484, 399, 488, 403, 478, 407, 485, 410, 493, 422, 495" href="<?php echo base_url('outlets/Johor')?>" target="_parent" alt="Johor" class="tooltips" onmouseover="tooltip.show('Johor');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="263, 427, 270, 405, 257, 398, 246, 400, 221, 402, 215, 409, 228, 423, 242, 429, 260, 435" href="<?php echo base_url('outlets/Malacca')?>" target="_parent" alt="Malacca" class="tooltips" onmouseover="tooltip.show('Malacca');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="201, 405, 190, 393, 196, 382, 198, 368, 210, 366, 216, 340, 226, 343, 248, 347, 262, 357, 280, 368, 273, 378, 270, 391, 267, 397, 236, 394, 222, 398, 209, 409" href="<?php echo base_url('outlets/Negeri-Sembilan')?>" target="_parent" alt="Negeri Sembilan" class="tooltips" onmouseover="tooltip.show('Negeri Sembilan');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="98, 284, 99, 271, 84, 258, 84, 229, 78, 204, 64, 188, 80, 186, 91, 189, 96, 173, 125, 150, 123, 139, 132, 129, 140, 135, 145, 125, 166, 118, 181, 117, 188, 125, 185, 139, 189, 151, 179, 162, 167, 179, 163, 199, 156, 220, 156, 234, 162, 248, 174, 268, 178, 294, 171, 296, 135, 294" href="<?php echo base_url('outlets/Perak')?>" target="_parent" alt="Perak" class="tooltips" onmouseover="tooltip.show('Perak');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="74, 64, 98, 68, 110, 76, 113, 89, 123, 85, 133, 90, 138, 101, 133, 111, 140, 112, 127, 121, 123, 134, 119, 153, 103, 168, 86, 182, 80, 146, 60, 138, 63, 115, 53, 93" href="<?php echo base_url('outlets/Kedah')?>" target="_parent" alt="Kedah" class="tooltips" onmouseover="tooltip.show('Kedah');" onmouseout="tooltip.hide();">			          
			          <area shape="poly" coords="66, 146, 77, 151, 77, 181, 66, 181, 69, 169" href="<?php echo base_url('outlets/Penang')?>" target="_parent" alt="Penang" class="tooltips" onmouseover="tooltip.show('Penang');" onmouseout="tooltip.hide();"/>
			          <area shape="poly" coords="61, 167, 48, 172, 48, 154, 57, 154" href="<?php echo base_url('outlets/Penang')?>" target="_parent" alt="Penang" class="tooltips" onmouseover="tooltip.show('Penang');" onmouseout="tooltip.hide();"/>
			          <area shape="poly" coords="38,87,36,92,38,94,41,92,40,89" href="<?php echo base_url('outlets/Penang')?>" target="_parent" alt="Penang" class="tooltips" onmouseover="tooltip.show('Penang');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="49, 50, 61, 49, 69, 66, 57, 83, 47, 91, 41, 72" href="#" target="_parent" alt="Perlis" class="tooltips" onmouseover="tooltip.show('Perlis');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="359, 394, 367, 379, 351, 361, 350, 321, 354, 313, 343, 295, 346, 279, 346, 265, 337, 262, 338, 284, 329, 282, 309, 268, 300, 269, 297, 259, 306, 240, 292, 237, 293, 217, 268, 221, 251, 218, 237, 225, 225, 215, 213, 226, 199, 218, 192, 232, 168, 234, 169, 244, 180, 265, 182, 290, 200, 307, 202, 326, 215, 333, 242, 341, 274, 360, 299, 375, 324, 391, 348, 387" href="<?php echo base_url('outlets/Pahang')?>" target="_parent" alt="Pahang" class="tooltips" onmouseover="tooltip.show('Pahang');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="224, 89, 246, 93, 261, 111, 262, 129, 250, 137, 253, 156, 258, 179, 267, 201, 274, 210, 257, 213, 243, 220, 229, 214, 211, 214, 199, 210, 192, 223, 176, 225, 163, 225, 166, 204, 172, 185, 177, 165, 192, 163, 196, 154, 190, 131, 203, 124, 207, 109" href="<?php echo base_url('outlets/Kelantan')?>" target="_parent" alt="Kelantan" class="tooltips" onmouseover="tooltip.show('Kelantan');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="267, 124, 290, 141, 321, 159, 337, 188, 348, 207, 352, 256, 334, 255, 331, 276, 314, 265, 302, 257, 305, 243, 297, 225, 276, 201, 267, 184, 259, 174, 259, 153, 256, 144, 257, 133" alt="Terengganu" class="tooltips" onmouseover="tooltip.show('Terengganu');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="785, 217, 779, 199, 782, 183, 754, 182, 762, 193, 769, 214, 751, 207, 749, 190, 737, 195, 741, 214, 736, 233, 728, 230, 706, 203, 687, 203, 686, 220, 631, 285, 554, 304, 542, 317, 545, 331, 529, 328, 529, 347, 525, 372, 517, 375, 517, 382, 492, 375, 470, 364, 468, 373, 446, 363, 440, 352, 433, 364, 442, 370, 443, 383, 458, 392, 467, 408, 485, 420, 506, 423, 530, 412, 545, 412, 566, 414, 575, 407, 589, 405, 587, 388, 603, 385, 607, 378, 636, 378, 632, 389, 677, 400, 701, 386, 718, 385, 722, 388, 727, 384, 734, 372, 738, 363, 745, 354, 741, 339, 749, 334, 762, 328, 765, 318, 757, 305, 778, 296, 788, 270, 788, 246, 787, 231" alt="Sarawak" class="tooltips" onmouseover="tooltip.show('Sarawak');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="444,201" href="#" target="_parent">
			          <area shape="poly" coords="941, 180, 993, 173, 997, 154, 979, 153, 951, 135, 935, 129, 929, 137, 916, 134, 928, 128, 923, 118, 906, 125, 904, 112, 910, 104, 910, 93, 900, 83, 890, 86, 881, 72, 875, 63, 865, 76, 856, 85, 856, 61, 846, 71, 839, 89, 814, 106, 810, 135, 801, 133, 799, 145, 774, 153, 773, 164, 784, 170, 777, 175, 790, 189, 784, 195, 794, 227, 800, 218, 829, 219, 833, 226, 837, 217, 886, 220, 891, 226, 904, 226, 904, 216, 917, 224, 937, 220, 960, 212, 947, 200, 936, 187" alt="Sabah" class="tooltips" onmouseover="tooltip.show('Sabah');" onmouseout="tooltip.hide();">
			          <area shape="poly" coords="194, 353, 200, 361, 190, 358" href="<?php echo base_url('outlets/Kuala-Lumpur')?>" target="_parent" alt="Kuala Lumpur" class="tooltips" onmouseover="tooltip.show('Kuala Lumpur');" onmouseout="tooltip.hide();/>			          
					  <area shape="poly" coords="389,220,394,227,399,231,401,236,406,237,408,239,413,234,414,232,416,228,419,225,416,220,415,213,419,210,423,208,426,212,428,217,431,221,433,223,436,225,437,219,437,215,436,211,433,207,431,204,431,203,416,207,416,202,411,209,404,214,396,215,389,218,388,219" class="tooltips">			          
			          <area shape="poly" coords="194, 341, 191, 331, 183, 339, 188, 347" href="<?php echo base_url('outlets/Kuala-Lumpur')?>" target="_parent" alt="Kuala Lumpur" class="tooltips" onmouseover="tooltip.show('Kuala Lumpur');" onmouseout="tooltip.hide();/>    				  			          			          
			          <area shape="poly" coords="389,220,394,227,399,231,401,236,406,237,408,239,413,234,414,232,416,228,419,225,416,220,415,213,419,210,423,208,426,212,428,217,431,221,433,223,436,225,437,219,437,215,436,211,433,207,431,204,431,203,416,207,416,202,411,209,404,214,396,215,389,218,388,219" class="tooltips">
			          <area shape="poly" coords="171, 386, 147, 373, 153, 358, 149, 337, 126, 311, 105, 292, 118, 291, 135, 302, 153, 305, 158, 296, 173, 305, 186, 297, 194, 305, 196, 316, 196, 326, 208, 338, 211, 343, 209, 356, 204, 364, 194, 376, 185, 393" href="<?php echo base_url('outlets/Selangor')?>" target="_parent" alt="Selangor" class="tooltips" onmouseover="tooltip.show('Selangor');" onmouseout="tooltip.hide();">			          			          
			          <area shape="poly" coords="185,255,192,250,197,249,205,249,208,251,210,255,208,258,203,260,194,257,190,257,185,257,183,255">
			      </map>
			</div>
			<?php }else{?>
			
			<table class="outlet_table">
				<thead>
				<tr>
					<th>No</th>
					<th>Outlet</th>
					<th>Address</th>
					<th width="15%">Contact</th>
				</tr>
				</thead>
				<tbody>
				
				<?php 
					$i = 1;
					foreach($outlets as $outlet):								
				?>
				
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $outlet->outlet?></td>
					<td><?php echo $outlet->address?></td>
					<td><?php echo $outlet->contact?></td>
				</tr>
				
				<?php 
					$i++;
					endforeach;				
				?>								
				</tbody>
			</table>
			
			<?php }?>
		</div>
	</div>
</div>	


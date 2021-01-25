--TEST--
yaz_record
--SKIPIF--
<?php if (!extension_loaded("yaz")) print "skip"; ?>
--FILE--
<?php
$z = yaz_connect("z3950.indexdata.com/marc");
yaz_range($z, 1, 2);
yaz_search($z, "rpn", "computer");
yaz_syntax($z, "marc21");
yaz_wait();
echo yaz_errno($z) . ":" . yaz_error($z) . ":" . yaz_addinfo($z) . "\n";
echo yaz_hits($z) . "\n";
echo yaz_record($z, 1, "string");
echo yaz_record($z, 1, "xml");
yaz_element($z, "B");
echo yaz_record($z, 1, "xml");
print_r(yaz_record($z, 1, "array"));
--EXPECT--
0::
10
00366nam  22001698a 4504
001    11224466 
003 DLC
005 00000000000000.0
008 910710c19910701nju           00010 eng  
010    $a    11224466 
040    $a DLC $c DLC
050 00 $a 123-xyz
100 10 $a Jack Collins
245 10 $a How to program a computer
260 1  $a Penguin
263    $a 8710
300    $a p. cm.

<record xmlns="http://www.loc.gov/MARC21/slim">
  <leader>00366nam a22001698a 4504</leader>
  <controlfield tag="001">   11224466 </controlfield>
  <controlfield tag="003">DLC</controlfield>
  <controlfield tag="005">00000000000000.0</controlfield>
  <controlfield tag="008">910710c19910701nju           00010 eng  </controlfield>
  <datafield tag="010" ind1=" " ind2=" ">
    <subfield code="a">   11224466 </subfield>
  </datafield>
  <datafield tag="040" ind1=" " ind2=" ">
    <subfield code="a">DLC</subfield>
    <subfield code="c">DLC</subfield>
  </datafield>
  <datafield tag="050" ind1="0" ind2="0">
    <subfield code="a">123-xyz</subfield>
  </datafield>
  <datafield tag="100" ind1="1" ind2="0">
    <subfield code="a">Jack Collins</subfield>
  </datafield>
  <datafield tag="245" ind1="1" ind2="0">
    <subfield code="a">How to program a computer</subfield>
  </datafield>
  <datafield tag="260" ind1="1" ind2=" ">
    <subfield code="a">Penguin</subfield>
  </datafield>
  <datafield tag="263" ind1=" " ind2=" ">
    <subfield code="a">8710</subfield>
  </datafield>
  <datafield tag="300" ind1=" " ind2=" ">
    <subfield code="a">p. cm.</subfield>
  </datafield>
</record>
<record xmlns="http://www.loc.gov/MARC21/slim">
  <leader>00122nam a22000618a 4504</leader>
  <controlfield tag="001">   11224466 </controlfield>
  <datafield tag="100" ind1="1" ind2="0">
    <subfield code="a">Jack Collins</subfield>
  </datafield>
  <datafield tag="245" ind1="1" ind2="0">
    <subfield code="a">How to program a computer</subfield>
  </datafield>
</record>
Array
(
    [0] => Array
        (
            [0] => (3,leader)
            [1] => 00122nam  22000618a 4504
        )

    [1] => Array
        (
            [0] => (3,001)
        )

    [2] => Array
        (
            [0] => (3,001)(3,@)
            [1] =>    11224466 
        )

    [3] => Array
        (
            [0] => (3,100)
        )

    [4] => Array
        (
            [0] => (3,100)(3,10)
        )

    [5] => Array
        (
            [0] => (3,100)(3,10)(3,a)
            [1] => Jack Collins
        )

    [6] => Array
        (
            [0] => (3,245)
        )

    [7] => Array
        (
            [0] => (3,245)(3,10)
        )

    [8] => Array
        (
            [0] => (3,245)(3,10)(3,a)
            [1] => How to program a computer
        )

)

<?php
include_once("include/functions.php");
// Базы данных

//******************************************************************************
// Таблица преобразования глобальных координат в координаты на картинке карты
// формат id=> Map, areaID, Y1, Y2, X1, X2, filename
$gAreaImagesCoord =array(
//******************************************************************************
//************************ Azeroth Areas ***************************************
//******************************************************************************
 14=>array(  0,    0,   18171.971,    -22569.211,    11176.344,   -15973.344, "azeroth/Azeroth.jpg"),
 15=>array(  0,   36,   783.333313, -2016.666626,         1500, -366.6666565, "azeroth/Alterac.jpg"),
 16=>array(  0,   45,  -866.666626, -4466.666504, -133.3333282, -2533.333252, "azeroth/Arathi.jpg"),
 17=>array(  0,    3, -2079.166504, -4566.666504, -5889.583008, -7547.916504, "azeroth/Badlands.jpg"),
 19=>array(  0,    4, -1241.666626, -4591.666504, -10566.66602,       -12800, "azeroth/BlastedLands.jpg"),
 20=>array(  0,   85,  3033.333252, -1485.416626,  3837.499756,   824.999939, "azeroth/Tirisfal.jpg"),
 21=>array(  0,  130,  3449.999756,         -750,  1666.666626, -1133.333252, "azeroth/Silverpine.jpg"),
 22=>array(  0,   28,  416.6666565, -3883.333252,  3366.666504,  499.9999695, "azeroth/WesternPlaguelands.jpg"),
 23=>array(  0,  139, -2185.416504,     -6056.25,  3799.999756,      1218.75, "azeroth/EasternPlaguelands.jpg"),
 24=>array(  0,  267,  1066.666626, -2133.333252,          400, -1733.333252, "azeroth/Hilsbrad.jpg"),
 26=>array(  0,   47,        -1575,        -5425,  1466.666626,        -1100, "azeroth/Hinterlands.jpg"),
 27=>array(  0,    1,  1802.083252, -3122.916504, -3877.083252, -7160.416504, "azeroth/DunMorogh.jpg"),
 28=>array(  0,   51, -322.9166565, -2554.166504,        -6100, -7587.499512, "azeroth/SearingGorge.jpg"),
 29=>array(  0,   46, -266.6666565, -3195.833252, -7031.249512, -8983.333008, "azeroth/BurningSteppes.jpg"),
 30=>array(  0,   12,  1535.416626, -1935.416626, -7939.583008, -10254.16602, "azeroth/Elwynn.jpg"),
 32=>array(  0,   41,  -833.333313, -3333.333252, -9866.666016, -11533.33301, "azeroth/DeadwindPass.jpg"),
 34=>array(  0,   10,   833.333313, -1866.666626, -9716.666016, -11516.66602, "azeroth/Duskwood.jpg"),
 35=>array(  0,   38, -1993.749878, -4752.083008,      -4487.5, -6327.083008, "azeroth/LochModan.jpg"),
 36=>array(  0,   44, -1570.833252, -3741.666504,        -8575, -10022.91602, "azeroth/Redridge.jpg"),
 37=>array(  0,   33,  2220.833252, -4160.416504,    -11168.75, -15422.91602, "azeroth/Stranglethorn.jpg"),
 38=>array(  0,    8, -2222.916504, -4516.666504, -9620.833008,       -11150, "azeroth/SwampOfSorrows.jpg"),
 39=>array(  0,   40,  3016.666504,  -483.333313,        -9400, -11733.33301, "azeroth/Westfall.jpg"),
 40=>array(  0,   11,  -389.583313,        -4525, -2147.916504, -4904.166504, "azeroth/Wetlands.jpg"),
301=>array(  0, 1519,     1722.917,      -14.583,    -7995.833,    -9154.166, "azeroth/Stormwind.jpg"),
341=>array(  0, 1537, -713.5913696, -1504.216431, -4569.241211, -5096.845703, "azeroth/Ironforge.jpg"),
382=>array(  0, 1497,   873.192627, -86.18240356,  1877.945313,  1237.841187, "azeroth/Undercity.jpg"),
//******************************************************************************
//************************ Kalimdor Areas **************************************
//******************************************************************************
 13=>array(  1,    0,  17066.59961, -19733.21094,  12799.90039,  -11733.2998, "kalimdor/Kalimdor.jpg"),
  4=>array(  1,   14, -1962.499878, -7249.999512,  1808.333252, -1716.666626, "kalimdor/Durotar.jpg"),
  9=>array(  1,  215,  2047.916626, -3089.583252, -272.9166565, -3697.916504, "kalimdor/Mulgore.jpg"),
 11=>array(  1,   17,  2622.916504, -7510.416504,  1612.499878,     -5143.75, "kalimdor/Barrens.jpg"),
 41=>array(  1,  141,  3814.583252, -1277.083252,     11831.25,       8437.5, "kalimdor/Teldrassil.jpg"),
 42=>array(  1,  148,  2941.666504, -3608.333252,  8333.333008,  3966.666504, "kalimdor/Darkshore.jpg"),
 43=>array(  1,  331,  1699.999878, -4066.666504,  4672.916504,   829.166626, "kalimdor/Ashenvale.jpg"),
 61=>array(  1,  400,  -433.333313, -4833.333008, -3966.666504, -6899.999512, "kalimdor/ThousandNeedles.jpg"),
 81=>array(  1,  406,  3245.833252, -1637.499878,  2916.666504,  -339.583313, "kalimdor/StonetalonMountains.jpg"),
101=>array(  1,  405,  4233.333008,       -262.5,   452.083313, -2545.833252, "kalimdor/Desolace.jpg"),
121=>array(  1,  357,  5441.666504, -1508.333252, -2366.666504, -6999.999512, "kalimdor/Feralas.jpg"),
141=>array(  1,   15,  -974.999939,        -6225, -2033.333252, -5533.333008, "kalimdor/Dustwallow.jpg"),
161=>array(  1,  440, -218.7499847, -7118.749512,        -5875,       -10475, "kalimdor/Tanaris.jpg"),
181=>array(  1,   16, -3277.083252, -8347.916016,  5341.666504,  1960.416626, "kalimdor/Aszhara.jpg"),
182=>array(  1,  361,  1641.666626, -4108.333008,  7133.333008,  3299.999756, "kalimdor/Felwood.jpg"),
201=>array(  1,  490,   533.333313, -3166.666504, -5966.666504, -8433.333008, "kalimdor/UngoroCrater.jpg"),
241=>array(  1,  493,     -1381.25, -3689.583252,  8491.666016,  6952.083008, "kalimdor/Moonglade.jpg"),
261=>array(  1, 1377,       2537.5, -945.8339844, -5958.333984,     -8281.25, "kalimdor/Silithus.jpg"),
281=>array(  1,  618, -316.6666565, -7416.666504,  8533.333008,  3799.999756, "kalimdor/Winterspring.jpg"),
321=>array(  1, 1637, -3680.601074, -5083.205566,  2273.877197,  1338.460571, "kalimdor/Ogrimmar.jpg"),
362=>array(  1, 1638,   516.666626,  -527.083313,  -849.999939, -1545.833252, "kalimdor/ThunderBluff.jpg"),
381=>array(  1, 1657,  2938.362793,  1880.029541,  10238.31641,  9532.586914, "kalimdor/Darnassis.jpg"),
//******************************************************************************
//***************************** BG  Areas **************************************
//******************************************************************************
401=>array( 30, 2597,  1781.249878,     -2456.25,  1085.416626, -1739.583252, "bg/alteracvalley.jpg"),
443=>array(489, 3277,  2041.666626,   895.833313,  1627.083252,   862.499939, "bg/warsonggulch.jpg"),
461=>array(529, 3358,  1858.333252,  102.0833282,  1508.333252,        337.5, "bg/arathibasin.jpg"),
482=>array(566, 3820,  2660.416504,   389.583313,      2918.75,  1404.166626, "bg/netherstormarena.jpg"),
512=>array(607, 4384,        787.5,      -956.25,     1883.333,      720.833, "bg/strandoftheancients.jpg"),
//******************************************************************************
//************************* Island  Areas **************************************
//******************************************************************************
480=>array(530, 3487,     -6400.75, -7612.208496,  10153.70898,  9346.938477, "islands/SilvermoonCity.jpg"),
462=>array(530, 3430,      -4487.5,      -9412.5,  11041.66602,  7758.333008, "islands/EversongWoods.jpg"),
463=>array(530, 3433, -5283.333008, -8583.333008,  8266.666016,  6066.666504, "islands/Ghostlands.jpg"),
471=>array(530, 3557, -11066.36719,  -12123.1377,  -3609.68335, -4314.371094, "islands/TheExodar.jpg"),
464=>array(530, 3524,       -10500, -14570.83301,     -2793.75, -5508.333008, "islands/AzuremystIsle.jpg"),
476=>array(530, 3525,       -10075, -13337.49902,  -758.333313, -2933.333252, "islands/BloodmystIsle.jpg"),
499=>array(530, 4080, -5302.083008, -8629.166016,  13568.74902,        11350, "islands/Sunwell.jpg"),
502=>array(609, 4298,    -4047.917,    -7210.417,       3087.5,      979.167, "islands/ScarletEnclave.jpg"),
//******************************************************************************
//************************* Outland Areas **************************************
//******************************************************************************
466=>array(530,    0,  12996.03906, -4468.039063,  5821.359375, -5821.359375, "outland/outland.jpg"),
465=>array(530, 3483,  5539.583008,          375,      1481.25, -1962.499878, "outland/Hellfire.jpg"),
467=>array(530, 3521,         9475,  4447.916504,  1935.416626, -1416.666626, "outland/Zangarmarsh.jpg"),
473=>array(530, 3520,         4225,        -1275, -1947.916626, -5614.583008, "outland/ShadowmoonValley.jpg"),
475=>array(530, 3522,  8845.833008,  3420.833252,  4408.333008,   791.666626, "outland/BladesEdgeMountains.jpg"),
477=>array(530, 3518,  10295.83301,  4770.833008,  41.66666412, -3641.666504, "outland/Nagrand.jpg"),
478=>array(530, 3519,  7083.333008,  1683.333252,  -999.999939,        -4600, "outland/TerokkarForest.jpg"),
479=>array(530, 3523,  5483.333008,   -91.666664,      5456.25,  1739.583252, "outland/Netherstorm.jpg"),
481=>array(530, 3703,  6135.258789,  4829.008789, -1473.954468, -2344.787842, "outland/ShattrathCity.jpg"),
//******************************************************************************
//************************ Northrend Areas **************************************
//******************************************************************************
485=>array(571,    0,     9217.152,    -8534.246,    10593.375,     -1240.89, "northrend/Northrend.jpg"),
486=>array(571, 3537,     8570.833,	     2806.25,     4897.917,     1054.167, "northrend/BoreanTundra.jpg"),
488=>array(571,   65,     3627.083,	    -1981.25,         5575,     1835.417, "northrend/Dragonblight.jpg"),
490=>array(571,  394,    -1110.417,	   -6360.417,     5516.667,     2016.667, "northrend/GrizzlyHills.jpg"),
491=>array(571,  495,    -1397.917,	    -7443.75,     3116.667,     -914.583, "northrend/HowlingFjord.jpg"),
492=>array(571,  210,      5443.75,     -827.083,     9427.083,     5245.833, "northrend/IcecrownGlacier.jpg"),
493=>array(571, 3711,     6929.167,     2572.917,       7287.5,     4383.333, "northrend/SholazarBasin.jpg"),
495=>array(571,   67,     1841.667,    -5270.833,    10197.916,      5456.25, "northrend/TheStormPeaks.jpg"),
496=>array(571,   66,         -600,     -5593.75,      7668.75,     4339.583, "northrend/ZulDrak.jpg"),
501=>array(571, 4197,     4329.167,     1354.167,     5716.667,     3733.333, "northrend/LakeWintergrasp.jpg"),
504=>array(571, 4395,      1052.51,      222.495,      6066.67,      5513.33, "northrend/Dalaran1_1.jpg"),
510=>array(571, 2817,      1443.75,    -1279.167,     6502.083,       4687.5, "northrend/CrystalsongForest.jpg")
);

$gZoneToAreaImage = array(
'-1'=>'0',
'1'=>'27',      // DunMorogh
'3'=>'17',      // Badlands
'4'=>'19',      // BlastedLands
'8'=>'38',      // SwampOfSorrows
'10'=>'34',     // Duskwood
'11'=>'40',     // Wetlands
'12'=>'30',     // Elwynn
'14'=>'4',      // Durotar
'15'=>'141',    // Dustwallow
'16'=>'181',    // Aszhara
'17'=>'11',     // Barrens
'28'=>'22',     // WesternPlaguelands
'33'=>'37',     // Stranglethorn
'36'=>'15',     // Alterac
'38'=>'35',     // LochModan
'40'=>'39',     // Westfall
'41'=>'32',     // DeadwindPass
'44'=>'36',     // Redridge
'45'=>'16',     // Arathi
'46'=>'29',     // BurningSteppes
'47'=>'26',     // Hinterlands
'51'=>'28',     // SearingGorge
'65'=>'488',    // Dragonblight
'66'=>'496',    // ZulDrak
'67'=>'495',    // TheStormPeaks
'85'=>'20',     // Tirisfal
'130'=>'21',    // Silverpine
'139'=>'23',    // EasternPlaguelands
'141'=>'41',    // Teldrassil
'148'=>'42',    // Darkshore
'210'=>'492',   // IcecrownGlacier
'215'=>'9',     // Mulgore
'267'=>'24',    // Hilsbrad
'331'=>'43',    // Ashenvale
'357'=>'121',   // Feralas
'361'=>'182',   // Felwood
'394'=>'490',   // GrizzlyHills
'400'=>'61',    // ThousandNeedles
'405'=>'101',   // Desolace
'406'=>'81',    // StonetalonMountains
'440'=>'161',   // Tanaris
'490'=>'201',   // UngoroCrater
'493'=>'241',   // Moonglade
'495'=>'491',   // HowlingFjord
'618'=>'281',   // Winterspring
'1377'=>'261',  // Silithus
'1497'=>'382',  // Undercity
'1519'=>'301',  // Stormwind
'1537'=>'341',  // Ironforge
'1637'=>'321',  // Ogrimmar
'1638'=>'362',  // ThunderBluff
'1657'=>'381',  // Darnassis
'2597'=>'401',  // AlteracValley
'2817'=>'510',  // CrystalsongForest
'3277'=>'443',  // WarsongGulch
'3358'=>'461',  // ArathiBasin
'3430'=>'462',  // EversongWoods
'3433'=>'463',  // Ghostlands
'3483'=>'465',  // Hellfire
'3487'=>'480',  // SilvermoonCity
'3518'=>'477',  // Nagrand
'3519'=>'478',  // TerokkarForest
'3520'=>'473',  // ShadowmoonValley
'3521'=>'467',  // Zangarmarsh
'3522'=>'475',  // BladesEdgeMountains
'3523'=>'479',  // Netherstorm
'3524'=>'464',  // AzuremystIsle
'3525'=>'476',  // BloodmystIsle
'3537'=>'486',  // BoreanTundra
'3557'=>'471',  // TheExodar
'3703'=>'481',  // ShattrathCity
'3711'=>'493',  // SholazarBasin
'3820'=>'482',  // NetherstormArena
'4080'=>'499',  // Sunwell
'4197'=>'501',  // LakeWintergrasp
'4298'=>'502',  // ScarletEnclave
'4384'=>'512',  // StrandoftheAncients
'4395'=>'504',  // Dalaran
);

function getRenderAreaData($area)
{
 global $gAreaImagesCoord;
 return @$gAreaImagesCoord[$area];
}

// Преобразует кординаты для ареа карт  (файл worldMapTransform.dbc)
// Когда объект физически находится на:
// - разных картах (карты островов)
// А вывод идeт на одну картинку но по другим координатам
// формат map, y1, y2, x1, x2, newmap, dx, dy
$areaMapTransform = array(
2=>array(530,    -4000,  -10000,   14000,  5000, 0,    -2400,  2400),
3=>array(530, -6933.333, -16000, 533.333, -8000, 1,10133.333, 17600)
);

function transformAreaCoordinates(&$map, &$x, &$y)
{
   global $areaMapTransform;
   foreach ($areaMapTransform as $conv)
   {
       if ($conv[0] == $map AND
           $conv[1] >=  $y  AND $conv[2] <=  $y AND
           $conv[3] >=  $x  AND $conv[4] <=  $x )
           {
             $map = $conv[5];
             $x  += $conv[6];
             $y  += $conv[7];
             return;
           }
   }
   return;
}

// Преобразует кординаты
// Когда объект физически находится на:
// - разных картах (карты островов)
// - карта многоэтажная
// А вывод идёт на одну картинку, но по другим координатам
// формат map, z1, z2, y1, y2, x1, x2, newmap, dx, dy, dz
$worldMapTransform = array(
2=>array(530, 2000, -2000, -4000, -10000, 14000,  5000,   0,     -2638,  2496, 0),
3=>array(530, 2000, -2000, -6933, -16000,   533, -8000,   1, 10133.333, 17600, 0),
// Scarlet Monastery
4=>array(189, 2000, -2000,  -200,   -500,   300,   100, 189,  578,  1469, 0),  // Library
5=>array(189, 2000, -2000,  -300,   -500,  2000,  1600, 189, -756,  1591, 0),  // Armory
6=>array(189, 2000, -2000,  1500,   1000,  1900,  1700, 189,  -970,  275, 0),  // Caveyard
// Shadowfang
7=>array( 33, 140,113.4,  2200, 2100,     -70,   -180,   33,     7,   -56, 0), // 2 floor
8=>array( 33, 160,  140,  2200, 2100,     -70,   -180,   33,   -12,  -108, 0), // 3 floor

);

function transformWorldCoordinates(&$map, &$x, &$y, &$z)
{
   global $worldMapTransform;
   foreach ($worldMapTransform as $conv)
   {
       if ($conv[0] == $map AND
           $conv[1] >=  $z  AND $conv[2] <=  $z AND
           $conv[3] >=  $y  AND $conv[4] <=  $y AND
           $conv[5] >=  $x  AND $conv[6] <=  $x)
           {
             $map = $conv[7];
             $x  += $conv[8];
             $y  += $conv[9];
             $z  += $conv[10];
             return;
           }
   }
   return;
}

// return true if map - dungeon
function isDungeon($id)
{
	if ($id==0 || $id == 1 || $id == 530 || $id ==571)
		return false;
	return true;
}

// Собственные данные для показа карт
// id, y1, y2, x1, x2, sizeY, sizeX, filename
static $gMapCoord =array(
    0=>array( 11200, -16000,  4264, -6936,1632, 672,"../azeroth_8x.jpg"),
    1=>array( 12262, -12804,  8536, -9064,1504,1056,"../kalimdor_8x.jpg"),
  530=>array(  5333,  -5867, 10133, -1067,1344,1344,"../outland_4x.jpg"),
  571=>array( 10667,  -1066,  8533, -8000,1408,1984,'../northrend_4x.jpg'),
// 13=>array(      ,       ,      ,      ,    ,    ,"Testing.jpg"),               // not use
// 25=>array(      ,       ,      ,      ,    ,    ,"ScottTest.jpg"),             // not use
// 29=>array(      ,       ,      ,      ,    ,    ,"CashTest.jpg"),              // not use
   30=>array(  1032,  -1676,   296,  -754,1300, 504,"AlteracValley.jpg"),
   33=>array(    -73,   -317,  2355, 2001, 488, 708,"ShadowfangKeep.jpg"),        // поворот на -69,16 (multilevel map)
   34=>array(   201,    -11,   158,  -158, 424, 632,"Stockade.jpg"),
// 35=>array(      ,       ,      ,      ,    ,    ,"unusedStormwindPrison.jpg"), // not use
   36=>array(   128,   -321,  -339, -1151, 898,1623,"Deadmines.jpg"),
// 37=>array(      ,       ,      ,      ,    ,    ,"AzsharaCrater.jpg"),         // not use
// 42=>array(      ,       ,      ,      ,    ,    ,"CollinTest.jpg"),            // not use
   43=>array(   192,   -399,   560,  -388,1182,1896,"WailingCaverns.jpg"),
// 44=>array(      ,       ,      ,      ,    ,    ,"unusedMonastery.jpg"),       // not use
   47=>array(  2241,   1926,  2044,  1380, 630,1326,"RazorfenKraul.jpg"),         // поворот на 47,29 град
   48=>array(   -72,   -900,   429,  -507,1656,1872,"BlackfathomDeeps.jpg"),
   70=>array(   189,   -375,   472,   -75,1128,1094,"Uldaman.jpg"),
   90=>array(  -196,   -920,   762,  -146,1448,1816,"Gnomeregan.jpg"),
  109=>array(  -241,   -718,   329,  -141, 954, 940,"SunkenTemple.jpg"),
  129=>array(  2635,   2244,  1145,   601, 781,1088,"RazorfenDowns.jpg"),
//169=>array(      ,       ,      ,      ,    ,    ,"EmeraldDream.jpg"),          // not use
  189=>array(  1237,    637,  1724,  1014,1200,1420,"ScarletMonastery.jpg"),      // use transform coordinates
  209=>array(  2062,   1143,  1433,   604, 441, 398,"ZulFarrak.jpg"),
//229=>array(      ,       ,      ,      ,    ,    ,"BlackrockSpire.jpg"),        // have many level -> passed
  230=>array(  1491,    252,   271,  -855,2478,2252,"BlackrockDepths.jpg"),
  249=>array(    67,   -225,    -8,  -292, 583, 568,"OnyxiasLair.jpg"),
  269=>array( -1327,  -2421,  7698,  6527, 525, 562,"CavernsOfTime.jpg"),
//289=>array(      ,       ,      ,      ,    ,    ,"Scholomance.jpg"),           // have many level -> passed
  309=>array(-11335, -12568, -1106, -2137, 592, 495,"ZulGurub.jpg"),
  329=>array(  4155,   3373, -2923, -3809,1564,1772,"Stratholme.jpg"),
  349=>array(  1172,   -174,   300,  -819,2692,2238,"Maraudon.jpg"),
//369=>array(      ,       ,      ,      ,    ,    ,"DeeprunTram.jpg"),           // not use это карта железной дороги между стормом и айроном
  389=>array(    23,   -426,   280,  -113, 898, 786,"OrgrimarInstance.jpg"),
  409=>array(  1338,    483,  -267, -1260,1710,1986,"MoltenCore.jpg"),
  429=>array(   943,   -224,   984,  -876,1167,1860,"DireMaul.jpg"),
  449=>array(    88,    -32,    43,   -97, 240, 280,"AlliancePVPBarracks.jpg"),
  450=>array(   277,    -87,   120,  -188, 729, 618,"HordePVPBarracks.jpg"),
//451=>array(      ,       ,      ,      ,    ,    ,"DevelopmentLand.jpg"),       // not use
//469=>array(      ,       ,      ,      ,    ,    ,"BlackwingLair.jpg"),         // have many level -> passed
  489=>array(  1698,    827,  1864,   994, 418, 418,"WarsongGulch.jpg"),
  509=>array( -8070, -10257,  2470,   950,1050, 730,"RuinsofAhnQiraj.jpg"),
//529=>array(      ,       ,      ,      ,    ,    ,"ArathiBasin.jpg"),           // bg
  531=>array( -7840,  -9372,  2255,   782,3064,2947,"AhnQirajTemple.jpg"),        // Поворот на 21.5 град
//532=>array(      ,       ,      ,      ,    ,    ,"Karazhan.jpg"),              // have many level -> passed
  533=>array(  3569,   2428, -2862, -4080,2282,2436,"Naxxramas.jpg"),
  534=>array(  5958,   4075, -1104, -4123, 904,1449,"TheBattleforMountHyjal.jpg"),
  540=>array(   582,    -46,   357,  -168,1256,1050,"TheShatteredHalls.jpg"),
  542=>array(   558,    -49,   219,  -229,1214, 896,"TheBloodFurnace.jpg"),
  543=>array(  -508,  -2176,  2376,   900, 834, 738,"Ramparts.jpg"),
  544=>array(   242,   -127,   122,  -111, 738, 466,"MagtheridonsLair.jpg"),
  545=>array(   132,   -406,    35,  -622,1076,1314,"TheSteamvault.jpg"),
  546=>array(   427,   -189,   191,  -610,1232,1602,"TheUnderbog.jpg"),
  547=>array( 157.5, -357.5,  44.5,-829.5,1030,1748,"TheSlavePens.jpg"),
  548=>array(   579,   -396,   121, -1161,1950,2564,"SerpentshrineCavern.jpg"),
  550=>array(   883,    -78,   501,  -509,1923,2021,"TheEye.jpg"),
  552=>array(   547,    -56,   247,  -306,1206,1106,"TheArcatraz.jpg"),
  553=>array(   232,   -266,   641,  -104, 996,1490,"TheBotanica.jpg"),
  554=>array(   354,   -104,   212,  -221, 916, 866,"TheMechanar.jpg"),
  555=>array(    86, -588.5,  83.5,-575.5,1349,1318,"ShadowLabyrinth.jpg"),
  556=>array(   124, -295.5,   385,   -70, 839, 910,"SethekkHalls.jpg"),
  557=>array(  84.5,   -438,  65.5,-306.5,1045, 744,"ManaTombs.jpg"),
  558=>array(298.75,-187.25,    56,-448.5, 972,1009,"AuchenaiCrypts.jpg"),
//559=>array(      ,       ,      ,      ,    ,    ,"NagrandArena.jpg"),          // bg
  560=>array(  3730,    530,  2667,  -533,1536,1536,"TheEscapeFromDurnholde.jpg"),
//562=>array(      ,       ,      ,      ,    ,    ,"BladeEdgeArena.jpg"),        // bg
//564=>array(      ,       ,      ,      ,    ,    ,"BlackTemple.jpg"),
  565=>array(   304,    -37,   445,   -32, 682, 954,"GruulsLair.jpg"),
  566=>array(  2873,   1433,  2118,   942, 891, 565,"EyeoftheStorm.jpg"),         // bg
  568=>array(   681,   -381,  1990,   254, 510, 833,"ZulAman.jpg"),
//572=>array(      ,       ,      ,      ,    ,    ,"RuinsofLordaeron.jpg"),      // not use
//573=>array(      ,       ,      ,      ,    ,    ,"ExteriorTest.jpg"),          // not use
//574=>array(      ,       ,      ,      ,    ,    ,"UtgardeKeep.jpg"),           //
//575=>array(      ,       ,      ,      ,    ,    ,"UtgardePinnacle.jpg"),       //
//576=>array(      ,       ,      ,      ,    ,    ,"TheNexus.jpg"),              //
//578=>array(      ,       ,      ,      ,    ,    ,"TheOculus.jpg"),             //
  580=>array(  2768,    512,  1691,  -259,1083, 937,"SunwellPlateau.jpg"),
//582=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Rut'theran to Auberdine
//584=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Menethil to Theramore
//585=>array(      ,       ,      ,      ,    ,    ,"MagisterTerrace.jpg"),       //
//586=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Exodar to Auberdine
//587=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Feathermoon Ferry
//588=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Menethil to Auberdine
//589=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Orgrimmar to Grom'Gol
//590=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Grom'Gol to Undercity
//591=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Undercity to Orgrimmar
//592=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Borean Tundra Test
//593=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Booty Bay to Ratchet
//594=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Howling Fjord Sister Mercy (Quest)
//595=>array(      ,       ,      ,      ,    ,    ,"CullingOfStratholme.jpg"),   //
//596=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Naglfar
//597=>array(      ,       ,      ,      ,    ,    ,"CraigTest.jpg"),             // not use
//598=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Sunwell Fix
//599=>array(      ,       ,      ,      ,    ,    ,"HallsOfStone.jpg"),
//600=>array(      ,       ,      ,      ,    ,    ,"DrakTharonKeep.jpg"),
//601=>array(      ,       ,      ,      ,    ,    ,"AzjolNerub.jpg"),
//602=>array(      ,       ,      ,      ,    ,    ,"HallsOfLightning.jpg"),
//603=>array(      ,       ,      ,      ,    ,    ,"Ulduar.jpg"),
//604=>array(      ,       ,      ,      ,    ,    ,"Gundrak.jpg"),
//605=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Development Land (non-weighted textures)
//606=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use QA and DVD
//607=>array(      ,       ,      ,      ,    ,    ,"StrandOfTheAncients.jpg"),
//608=>array(      ,       ,      ,      ,    ,    ,"VioletHold.jpg"),
//609=>array(      ,       ,      ,      ,    ,    ,"EbonHold.jpg"),
//610=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Tirisfal to Vengeance Landing
//612=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Menethil to Valgarde
//613=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Orgrimmar to Warsong Hold
//614=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Stormwind to Valiance Keep
//615=>array(      ,       ,      ,      ,    ,    ,"TheObsidianSanctum.jpg"),
//616=>array(      ,       ,      ,      ,    ,    ,"TheEyeOfEternity.jpg"),
//617=>array(      ,       ,      ,      ,    ,    ,"DalaranSewers.jpg"),
//618=>array(      ,       ,      ,      ,    ,    ,"TheRinOfValor.jpg"),
//619=>array(      ,       ,      ,      ,    ,    ,"TheOldKingdom.jpg"),
//620=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Moa'ki to Unu'pe
//621=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Moa'ki to Kamagua
//622=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: Orgrim's Hammer
//623=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not use Transport: The Skybreaker
//624=>array(      ,       ,      ,      ,    ,    ,"WintergraspRaid.jpg"),
//628=>array(      ,       ,      ,      ,    ,    ,"IsleofConquest.jpg"),
//631=>array(      ,       ,      ,      ,    ,    ,"IcecrownCitadel.jpg"),
//632=>array(      ,       ,      ,      ,    ,    ,"IcecrownCitadel5Man.jpg"),
//641=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport_AllianceAirshipBG
//642=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport_HordeAirshipBG
//647=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport_Orgrimmar_to_Thunderbluff
//649=>array(      ,       ,      ,      ,    ,    ,"ArgentTournamentRaid.jpg"),
//650=>array(      ,       ,      ,      ,    ,    ,"ArgentTournamentDungeon.jpg"),
//658=>array(      ,       ,      ,      ,    ,    ,"QuarryofTears.jpg"),
//668=>array(      ,       ,      ,      ,    ,    ,"HallsOfReflection.jpg"),
//672=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport197347
//673=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport197348
//712=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport197349
//713=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport197350
//718=>array(      ,       ,      ,      ,    ,    ,".jpg"),                      // not useTransport201834
//723=>array(      ,       ,      ,      ,    ,    ,"Stormwind.jpg"),
//724=>array(      ,       ,      ,      ,    ,    ,"ChamberofAspectsRed.jpg"),
);

function getRenderMapData($map)
{
 global $gMapCoord;
 return @$gMapCoord[$map];
}

$gMapIcon = array(
'0'=>"EasternKingdoms.gif",
'1'=>"Kalimdor.gif",
'30'=>"Battleground.gif",
'33'=>"ShadowFangKeep.gif",
'34'=>"StormwindStockades.gif",
'36'=>"Deadmines.gif",
'43'=>"WailingCaverns.gif",
'47'=>"RazorfenKraul.gif",
'48'=>"BlackfathomDeeps.gif",
'70'=>"Uldaman.gif",
'90'=>"Gnomeregan.gif",
'109'=>"SunkenTemple.gif",
'129'=>"RazorfenDowns.gif",
'189'=>"ScarletMonastery.gif",
'209'=>"ZulFarak.gif",
'229'=>"BlackrockSpire.gif",
'230'=>"BlackrockDepths.gif",
'249'=>"Raid.gif",
'269'=>"CavernsOfTime.gif",
'289'=>"Scholomance.gif",
'309'=>"ZulGurub.gif",
'329'=>"Stratholme.gif",
'349'=>"Maraudon.gif",
'389'=>"RagefireChasm.gif",
'409'=>"MoltenCore.gif",
'429'=>"DireMaul.gif",
'469'=>"BlackwingLair.gif",
'489'=>"WarsongGulch.gif",
'509'=>"AQRuins.gif",
'529'=>"ArathiBasin.gif",
'530'=>"Outland.gif",
'531'=>"AQTemple.gif",
'532'=>"Karazhan.gif",
'533'=>"Naxxramas.gif",
'534'=>"HyjalPast.gif",
'540'=>"HellfireCitadel.gif",
'542'=>"HellfireCitadel.gif",
'543'=>"HellfireCitadel.gif",
'544'=>"HellfireCitadelRaid.gif",
'545'=>"CoilFang.gif",
'546'=>"CoilFang.gif",
'547'=>"CoilFang.gif",
'548'=>"SerpentshrineCavern.gif",
'550'=>"TempestKeep.gif",
'552'=>"TempestKeep.gif",
'553'=>"TempestKeep.gif",
'554'=>"TempestKeep.gif",
'555'=>"Auchindoun.gif",
'556'=>"Auchindoun.gif",
'557'=>"Auchindoun.gif",
'558'=>"Auchindoun.gif",
'560'=>"CavernsOfTime.gif",
'564'=>"BlackTemple.gif",
'565'=>"GruulsLair.gif",
'568'=>"ZulAman.gif",
'580'=>"Sunwell.gif",
'585'=>"MagistersTerrace.gif"
);

function getMapIcon($map)
{
 global $gMapIcon;
 $ico = @$gMapIcon[$map];
 if (empty($ico)) $ico = "Uncnown.gif";
 return "images/map_icons/".$ico;
}

// Вывод картинки на общей карте GPS
// формат:
// posX - координата левого верхнего угла карты
// posY - координата левого верхнего угла карты
// y - координата фактическоо расположения карты на изображении
// x - координата фактическоо расположения карты на изображении
// scale - масштаб
$gGpsMap = array(
  0=>array(11200, 4264, 128,  960,  0.48/16),
  1=>array(12262, 8536, 192,    0,  0.48/16),
530=>array( 5333,10133, 464,  576,  0.48/16),
571=>array(10667, 8533,   0,  496,  0.48/16),
);

function getRenderGPSMapData($map)
{
 global $gGpsMap;
 return @$gGpsMap[$map];
}

function getWMOArea($area, $map, $x, $y, $z)
{
    // some hacks for areas above or underground for ground area
         if ($map == 571 && $z > 563 && $y >   282 && $y <   982 && $x > 5568 && $x < 6116) $area = 4395; // Dalaran
    else if ($map ==   0 && $z <  30 && $y >   -86 && $y <   873 && $x > 1237 && $x < 1877) $area = 1497; // Undecity
    else if ($map == 530 && $z < -10 && $y >-12123 && $y <-11066 && $x >-4314 && $x <-3609) $area = 3557; // The Exodar
    else if ($map ==   0 &&             $y > -1504 && $y <  -713 && $x >-5096 && $x <-4569) $area = 1537; // Ironforge
    return $area;
}

//======================================================
// Получениие id структуры зоны при имеющихся координатах
// Реализовано с помощью аналога GPS карты только на картинке
// цветами обозначены зоны.
$gAreaMaskImage = NULL;
function getAreaIdFromPoint(&$posMap, $posX, $posY, $posZ)
{
  global $gAreaMaskImage, $gAreaColors;
  // Ошибка загрузки картинки - возвращаемся
  if ($gAreaMaskImage == -1)
      return -1;
  // Если картинка не была еще загружена - грузим ее
  if ($gAreaMaskImage == 0)
  {
      $gAreaMaskImage = imagecreatefrompng("images/map_image/areamask.png");
      if ($gAreaMaskImage == 0)
          return $gAreaMaskImage = -1;
  }
  // Преобразуем сетку координат
  transformWorldCoordinates($posMap, $posX, $posY, $posZ);
  // Точка присутствует на GPS карте
  if ($gps = getRenderGPSMapData($posMap))
  {
      $x = intval($gps[2]+$gps[4]*($gps[0] - $posX));
      $y = intval($gps[3]+$gps[4]*($gps[1] - $posY));
      // Получаем цвет точки по координатам и вычислем зону
      if ($area = @imagecolorat($gAreaMaskImage, $y, $x))
         return getWMOArea($area, $posMap, $posX, $posY, $posZ);
  }
  return -1;
}

function getZoneFromPoint(&$posMap, $posX, $posY, $posZ)
{
  $areaId = getAreaIdFromPoint($posMap, $posX, $posY, $posZ);
  $area_data = getArea($areaId);
  if ($area_data && $area_data['zone_id'])
      return $area_data['zone_id'];
  return $areaId;
}

// Возвращает id картинки по координатам
function getAreaImageIdFromPoint(&$posMap, $posX, $posY, $posZ)
{
  global $gZoneToAreaImage;
  $zone = getZoneFromPoint($posMap, $posX, $posY, $posZ);
  if ($zone > 0)
       return isset($gZoneToAreaImage[$zone]) ? $gZoneToAreaImage[$zone] : -1;
  return -1;
}

// Возвращает имя зоны по координатам
function getAreaNameFromPoint($posMap, $posX, $posY, $posZ)
{
  $areaId = getAreaIdFromPoint($posMap, $posX, $posY, $posZ);
  if ($areaId==-1)
      return "";
  $area_data = getArea($areaId);
  $zone_data = $area_data['zone_id'] ? getArea($area_data['zone_id']):$area_data;
  if ($zone_data['name']!=$area_data['name'])
      return $zone_data['name']." - ".$area_data['name'];
  return $zone_data['name'];
}

// Возвращает имя карты по координатам
function getMapNameFromPoint($posMap, $posX, $posY, $posZ)
{
  transformWorldCoordinates($posMap, $posX, $posY, $posZ);
  return getMapName($posMap);
}

// Саllback функция для вывода точек и их информации на картах.
function defaultMapRenderCallback($data, $x, $y)
{
   global $lang;
   $img    = "images/map_points/gps_icon.png";
   $imgX   = 16;
   $imgY   = 16;
   $x = round($x-$imgX/2, 0);
   $y = round($y-$imgY/2, 0);

   $area = getAreaIdFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);
   if ($area_data = getArea($area))
     $areaname = $area_data['zone_id'] ? getAreaName($area_data['zone_id'],0).' ('.$area_data['name'].')' : $area_data['name'];
   else
     $areaname = '';
   if ($data['type']=='n') {
    $text = getCreatureName($data['id'], 0)." ($data[guid])<br>$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);
   if (getCreatureEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getCreatureEvent($data['guid'])), $text, 0, 0);
   if (getCreatureEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getCreatureEvent($data['guid']))), $text, 0, 0);
   if (getCreaturePool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePool($data['guid']).")", $text, 0, 0);
   if (getCreaturePoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePoolTemplate($data['id']).")", $text, 0, 0);
   }
   if ($data['type']=='o') {
    $text = getGameobjectName($data['id'], 0)." ($data[guid])<br>$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);
   if (getGameobjectEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getGameobjectEvent($data['guid'])), $text, 0, 0);
   if (getGameobjectEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getGameobjectEvent($data['guid']))), $text, 0, 0);
   if (getGameobjectPool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPool($data['guid']).")", $text, 0, 0);
   if (getGameobjectPoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPoolTemplate($data['id']).")", $text, 0, 0);
   }
   if ($data['type']=='i')
    $text = $areaname;
   if ($data['type']=='w')
    $text = $data['point'];
   return '<img src="'.$img.'" class=point style="left: '.$x.'px; top: '.$y.'px;" '.addTooltip($text).'>'."\n";
}

function defaultAreaRenderCallback($area_id, $data, $x, $y)
{
   global $gZoneToAreaImage, $lang;
   $area = getAreaIdFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);
   if (!$area)
       return;
   $area_data = getArea($area);

   $zone = $area_data['zone_id'] ? $area_data['zone_id'] : $area;
   $mapname  = getMapName($data['map']);
   $areaname = $area_data['zone_id'] ? getAreaName($area_data['zone_id'],0)." (".$area_data['name'].")" : $area_data['name'];

   if ($data['type']=='n') {
    $text = getCreatureName($data['id'], 0)."&nbsp;($data[guid])<br>$mapname&nbsp;-&nbsp;$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);
   if (getCreatureEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getCreatureEvent($data['guid'])), $text, 0, 0);
   if (getCreatureEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getCreatureEvent($data['guid']))), $text, 0, 0);
   if (getCreaturePool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePool($data['guid']).")", $text, 0, 0);
   if (getCreaturePoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePoolTemplate($data['id']).")", $text, 0, 0);
   }
   if ($data['type']=='o') {
    $text = getGameobjectName($data['id'], 0)."&nbsp;($data[guid])<br>$mapname&nbsp;-&nbsp;$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);
   if (getGameobjectEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getGameobjectEvent($data['guid'])), $text, 0, 0);
   if (getGameobjectEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getGameobjectEvent($data['guid']))), $text, 0, 0);
   if (getGameobjectPool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPool($data['guid']).")", $text, 0, 0);
   if (getGameobjectPoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPoolTemplate($data['id']).")", $text, 0, 0);
   }
   if ($data['type']=='i')
    $text = "$mapname - $areaname";
   if ($data['type']=='w')
    $text = $data['point'];
   if ($gZoneToAreaImage[$zone] == $area_id)
       $img    = "images/map_points/gps_icon.png";
   else
       $img    = "images/map_points/gps_icon1.png";
   $imgX   = 16;
   $imgY   = 16;
   $x = round($x-$imgX/2, 0);
   $y = round($y-$imgY/2, 0);

   return '<img src="'.$img.'" class=point style="left: '.$x.'px; top: '.$y.'px;" '.addTooltip($text).'>'."\n";
}

function renderGPSMap($header, $outSizeX, $pointsList = 0, $render = 'defaultMapRenderCallback')
{
  $imageY = $outSizeX==0 ? 1296 : $outSizeX;
  $imageX = $outSizeX==0 ?  944 : intval(944 * $outSizeX / 1296);
  $imageScale = $imageY/1296;
  $image  = "images/map_image/gps_map.jpg";

  $sizeX = $imageX+4;
  $sizeY = $imageY;
  $tableBorder = 1;
  $tableWidth  = $sizeY+$tableBorder*2+8;
  echo "<table class=\"map\" border=$tableBorder width=$tableWidth>";
  echo "<tbody>";
  echo "<tr><td class=mapname>".$header."</td></tr>";
  echo "<tr><td width=$sizeY height=$sizeX align=left valign=top>";
  echo "<div style=\"position: relative; border: 0px; left: 0px; top: 0px;\">";
  echo "<img src=$image width={$imageY}px height={$imageX}px>\n";

  if($pointsList)
  foreach ($pointsList as $point)
  {
     if ($gps = getRenderGPSMapData($point['map']))
     {
        $posMap= $point['map'];
        $posX  = $point['position_x'];
        $posY  = $point['position_y'];
        $posZ  = $point['position_z'];

        transformWorldCoordinates($posMap, $posX, $posY, $posZ);
        if ($gps = getRenderGPSMapData($posMap))
        {
          $x = ($gps[2]+$gps[4]*($gps[0] - $posX))*$imageScale;
          $y = ($gps[3]+$gps[4]*($gps[1] - $posY))*$imageScale;
          if ($x>=0 && $x < 944 && $y>=0 && $y < 1296)
            echo $render($point, $y, $x);
        }
     }
  }
  echo "</div>";
  echo "</td></tr></tbody>";
  echo "</table>";
}

function getAreaNameFromId($areaId)
{
  $area = getRenderAreaData($areaId);
  if (empty($area))
      return "$lang[map_no_found]&nbsp;$areaId";
  if ($area[1] == 0)
      return getMapName($area[0]);
  return getAreaName($area[1]);
}

function renderArea($areaId, $outSizeX = 0, $pointsList = 0, $render = 'defaultAreaRenderCallback')
{
  global $gAreaCoord;
  $area = getRenderAreaData($areaId);
  if (empty($area))
  {
      echo "$lang[map_no_found]&nbsp;$areaId<br>";
      return;
  }
  // Данные карты
  $mapId  = $area[0];
  $name   = $area[1] == 0 ? getMapName($mapId): getAreaName($area[1]);
  $areaY1 = $area[2];
  $areaY2 = $area[3];
  $areaX1 = $area[4];
  $areaX2 = $area[5];
  $imageY = $outSizeX==0 ? 1002 : $outSizeX;
  $imageX = $outSizeX==0 ?  668 : intval(668 * $outSizeX / 1002);
  $image  = "images/map_image/areas/".$area[6];

  $sizeX = $imageX+4;
  $sizeY = $imageY;
  $tableBorder = 1;
  $tableWidth  = $sizeY+$tableBorder*2+8;
  echo "<table class=\"map\" border=$tableBorder width=$tableWidth>";
  echo "<tbody><tr><td class=mapname id=mappername>$name</td></tr>";
  echo "<tr><td width=$sizeY height=$sizeX align=left valign=top>";
  echo "<div id=mapperarea style=\"font-size: 10px; position: relative; border: 0px; left: 0px; top: 0px;\" onmousemove=outMouseCoords(this,event,'mappercoord') onmouseout=cleanMouseCoords('mappercoord')>";
  echo "<img src=$image width={$imageY}px height={$imageX}px>\n";
  if($pointsList)
  foreach ($pointsList as $point)
  {
     $posMap= $point['map'];
     $posX  = $point['position_x'];
     $posY  = $point['position_y'];
     if ($area[1] == 0)
       transformAreaCoordinates($posMap, $posX, $posY);
     if ($mapId == $posMap AND
         $areaY1 >= $posY AND $areaY2 <= $posY AND
         $areaX1 >= $posX AND $areaX2 <= $posX)
     {
       $x = $imageX*($posX-$areaX1)/($areaX2-$areaX1);
       $y = $imageY*($posY-$areaY1)/($areaY2-$areaY1);
       echo $render($areaId, $point, $y, $x);
     }
  }
  echo '<div id=mappercoord style="position: absolute; left: 10px; bottom: 15px;"></div>';

  echo "</div>";
  echo "</td></tr></tbody>";
  echo "</table>";
}

function renderMap($mapId, $outSizeX = 0, $pointsList = 0, $render = 'defaultMapRenderCallback')
{
  global $gMapCoord, $gmapName, $lang;
  $mapName = '<a href=?instance='.$mapId.'>'.getMapName($mapId).'</a>';
  if (empty($mapName))
  {
      echo "$lang[map_no_found]&nbsp;$mapId<br>";
      return;
  }
  $map = getRenderMapData($mapId);
  if (empty($map))
  {
      echo "$lang[no_image]&nbsp;$mapName&nbsp;($mapId)<br>";
      return;
  }
  // Данные карты
  $areaX1 = $map[0];
  $areaX2 = $map[1];
  $areaY1 = $map[2];
  $areaY2 = $map[3];
  $imageY = $outSizeX==0 ? $map[5] : $outSizeX;
  $imageX = $outSizeX==0 ? $map[4] : intval($map[4] * $outSizeX / $map[5]);
  $image  = "images/map_image/maps/".$map[6];

  $sizeX = $imageX+4;
  $sizeY = $imageY;
  $tableBorder = 1;
  $tableWidth  = $sizeY+$tableBorder*2+8;
  echo "<table class=map border=$tableBorder width={$tableWidth}px>";
  echo "<tbody><tr><td id=mappername class=mapname>$mapName</td></tr>";
  echo "<tr><td width={$sizeY}px height={$sizeX}px align=left valign=top>";
  echo "<div id=mapperarea style=\"position: relative; border: 0px; left: 0px; top: 0px;\">";
  echo "<img src=$image width={$imageY}px height={$imageX}px>\n";

  if ($pointsList)
  foreach ($pointsList as $point)
  {
     $posMap= $point['map'];
     $posX  = $point['position_x'];
     $posY  = $point['position_y'];
     $posZ  = $point['position_z'];
     transformWorldCoordinates($posMap, $posX, $posY, $posZ);
     if ($mapId == $posMap AND
         $areaY1 >= $posY AND $areaY2 <= $posY AND
         $areaX1 >= $posX AND $areaX2 <= $posX)
     {
       $x = $imageX*($posX-$areaX1)/($areaX2-$areaX1);
       $y = $imageY*($posY-$areaY1)/($areaY2-$areaY1);
       echo $render($point, $y, $x);
     }
  }
  echo "</div>";
  echo "</td></tr></tbody>";
  echo "</table>";
}

class mapPoints{
  var $points = array();
  function getCount(){ return count($this->points);}
  //*************************************
  // Add creature list
  //*************************************
  function addNpc($id, $map = -1)
  {
    global $dDB;
    $list = $dDB->select('SELECT
    \'n\' AS `type`,
    `guid`,
    `id`,
    `map`,
    `spawnMask`,
    `phaseMask`,
    `modelid`,
    `equipment_id`,
    `position_x`,
    `position_y`,
    `position_z`,
    `orientation`,
    `spawntimesecs`,
    `spawndist`,
    `currentwaypoint`,
    `curhealth`,
    `curmana`,
    `DeathState`,
    `MovementType`
    FROM `creature` WHERE `id` = ?d {AND `map` = ?d}', $id, $map==-1? DBSIMPLE_SKIP:$map);
	if ($list) $this->points = array_merge($this->points, $list);
  }
  //*************************************
  // Add object list
  //*************************************
  function addGo($id, $map = -1)
  {
    global $dDB;
    $list = $dDB->select('SELECT
    \'o\' AS `type`,
    `guid`,
    `id`,
    `map`,
    `spawnMask`,
    `phaseMask`,
    `position_x`,
    `position_y`,
    `position_z`,
    `orientation`,
    `spawntimesecs`,
    `state`
    FROM `gameobject` WHERE `id` = ?d {AND `map` = ?d}', $id, $map==-1? DBSIMPLE_SKIP:$map);
	if ($list) $this->points = array_merge($this->points, $list);
  }
  //*************************************
  // Add waypoints list
  //*************************************
  function addWaypoint($id, $map)
  {
    global $dDB;
    $list = $dDB->select('SELECT
    \'w\' AS `type`,
    `id`,
    `point`,
	?d AS `map`,
    `position_x`,
    `position_y`,
    `position_z`,
    `waittime`,
    `spell`
    FROM `creature_movement` WHERE `id` = ?d ', $map, $id);
	if ($list) $this->points = array_merge($this->points, $list);
  }

  //*************************************
  // Add point
  //*************************************
  function addPoint($map, $x, $y, $z)
  {
    $this->points[] = array('type'=>'i', 'map'=>$map, 'position_x'=>$x, 'position_y'=>$y, 'position_z'=>$z);
  }

  //*************************************
  // Create area and maps list from points
  //*************************************
  function getMapsList()
  {
    $gpsCount = 0;
    $areaList= array();
    $mapsList= array();
    foreach ($this->points as $point)
    {
       $a = getAreaImageIdFromPoint($point['map'], $point['position_x'], $point['position_y'], $point['position_z']);
       if ($a>0) @$areaList[$a]++;
       @$mapsList[$point['map']]++;
    }
    $area_keys = array_keys($areaList);
    $maps_keys = array_keys($mapsList);

    $list = array();
    if ($area_keys)
       foreach($areaList as $id=>$count)
          $list['area'][]=array('id'=>$id, 'text'=>getAreaNameFromId($id).' - ('.$count.')');

	if ($mapsList)
       foreach($mapsList as $id=>$count)
	   {
	      if (getRenderGPSMapData($id)) $gpsCount+=$count;
          $list['map'][]=array('id'=>$id, 'text'=>getMapName($id).' - ('.$count.')');
       }
	if ($gpsCount)
       $list['gps'][]=array('text'=>'('.$gpsCount.')');

    return $list;
  }
};

function getPointData($area_id, &$data, $x, $y)
{
   global $gZoneToAreaImage, $lang;

   $area = getAreaIdFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);
   $area_data = getArea($area);
   if (!$area_data)
       return 0;
   $zone     = @$area_data['zone_id'] ? $area_data['zone_id'] : $area;
   $areaname = $area_data['zone_id'] ? getAreaName($zone)." (".$area_data['name'].")" : $area_data['name'];
   $img = 'images/map_points/';
   $img.= ($gZoneToAreaImage[$zone] == $area_id) ? 'gps_icon.png' : 'gps_icon1.png';
   $imgX = 16;
   $imgY = 16;
   $name = '';
   if (@$data['type']=='n') {
    $text = getCreatureName($data['id'], 0)."&nbsp;($data[guid])<br>$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);           
   if (getCreatureEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getCreatureEvent($data['guid'])), $text, 0, 0);
   if (getCreatureEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getCreatureEvent($data['guid']))), $text, 0, 0);
   if (getCreaturePool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePool($data['guid']).")", $text, 0, 0);
   if (getCreaturePoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getCreaturePoolTemplate($data['id']).")", $text, 0, 0);
   }
   if (@$data['type']=='o') {
    $text =getGameobjectName($data['id'], 0)."&nbsp;($data[guid])<br>$areaname<br>$lang[respawn]&nbsp;".getTimeText($data['spawntimesecs']);
   if (getGameobjectEvent($data['guid'])>0)
    $text = substr_replace("<br>$lang[spawn_at_event]&nbsp;-&nbsp;".getGameEventName(getGameobjectEvent($data['guid'])), $text, 0, 0);
   if (getGameobjectEvent($data['guid'])<0)
    $text = substr_replace("<br>$lang[despawn_at_event]&nbsp;-&nbsp;".getGameEventName(abs(getGameobjectEvent($data['guid']))), $text, 0, 0);
   if (getGameobjectPool($data['guid']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPool($data['guid']).")", $text, 0, 0);
   if (getGameobjectPoolTemplate($data['id']))
    $text = substr_replace("<br>$lang[pool]&nbsp;(".getGameobjectPoolTemplate($data['id']).")", $text, 0, 0);
   }
   return array(
         'id'=>$data['id'],
         'x'=>$y,
         'y'=>$x,
         'imgX'=>$imgX,
         'imgY'=>$imgY,
         'image'=>$img,
         'href'=>"",
         'tooltip'=> $text);
}
function get_mapAreaData($areaId, $pointsList = 0)
{
  global $gAreaCoord;
  $area = getRenderAreaData($areaId);
  if (empty($area))
  {
      echo "$lang[map_no_found]&nbsp;$areaId<br>";
      return;
  }
  $map = array();
  // Данные карты
  $mapId  = $area[0];
  $areaY1 = $area[2];
  $areaY2 = $area[3];
  $areaX1 = $area[4];
  $areaX2 = $area[5];

  $map['header']= $area[1] == 0 ? getMapName($mapId): getAreaName($area[1]);
  $map['width'] = 1002;
  $map['height']= 668;
  $map['coord'] = 0;
  $map['image'] = "images/map_image/areas/".$area[6];

  if($pointsList)
  foreach ($pointsList as &$point)
  {
     $posMap= $point['map'];
     $posX  = $point['position_x'];
     $posY  = $point['position_y'];
     if ($area[1] == 0)
       transformAreaCoordinates($posMap, $posX, $posY);
     if ($mapId == $posMap AND
         $areaY1 >= $posY AND $areaY2 <= $posY AND
         $areaX1 >= $posX AND $areaX2 <= $posX)
     {
       $x = ($posX-$areaX1)/($areaX2-$areaX1); // 0-1 on image
       $y = ($posY-$areaY1)/($areaY2-$areaY1); // 0-1 on image
       $map['points'][]=getPointData($areaId, $point, $x, $y);
     }
  }
  return $map;
}
?>
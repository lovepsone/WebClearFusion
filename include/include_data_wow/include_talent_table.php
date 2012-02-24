<?php

function noBorderTalentTable($talentTab, $rank)
{
 global $game_text;
 if ($rank) $spell = getSpell($talentTab["Rank_$rank"]);
 else       $spell = getSpell($talentTab["Rank_1"]);

 if ($spell)
 {
  $maxRank = 0;
       if ($talentTab["Rank_5"]) $maxRank = 5;
  else if ($talentTab["Rank_4"]) $maxRank = 4;
  else if ($talentTab["Rank_3"]) $maxRank = 3;
  else if ($talentTab["Rank_2"]) $maxRank = 2;
  else if ($talentTab["Rank_1"]) $maxRank = 1;

  echo "<table class=spell><tbody>";
  $name = $spell['SpellName'];
//  if ($spell['Rank']) $name .=" ($spell[Rank])";
  echo "<tr><td class=Name>".$name."</td></tr>";
  echo "<tr><td>".$game_text['talent_rank']." $rank / $maxRank</td></tr>";
  echo "<tr><td class=Talent>".getSpellDesc($spell)."</td></tr>";
  if ($rank!=0 && $rank!=$maxRank)
  {
   echo "<tr><td><br>".$game_text['talent_next_rank']."</td></tr>";
   $spell = getSpell($talentTab["Rank_".($rank+1)]);
   echo "<tr><td class=Talent>".getSpellDesc($spell)."</td></tr>";
  }
  echo "</tbody></table>";
 }
 else
 {
  echo "Talent error";
 }
}
function generateTalentTable($talentTab, $rank)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderTalentTable($talentTab, $rank);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>
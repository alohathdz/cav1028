    <!-- Function วรรคเลขบัตรประชาชน -->
    <?php
    function FnID($p_eid)
    {
      $srt[0] = substr($p_eid, 0, 1);
      $srt[1] = substr($p_eid, 1, 4);
      $srt[2] = substr($p_eid, 5, 5);
      $srt[3] = substr($p_eid, 10, 2);
      $srt[4] = substr($p_eid, 12, 1);
      return $srt[0] . " " . $srt[1] . " " . $srt[2] . " " . $srt[3] . " " . $srt[4];
    }
    ?>
<div class="row" id="content5" style="display: none;">
    <div class="row" style="position: relative;">
        <div class="col xl12 section white">
            <ul>
                <li class="center-align"><b>History of Reviewed Complaints</b></li>
            </ul>
            <div class="white">
                <ul class="collapsible">
                    <?php
                    $complains = DB::query("SELECT * FROM complains WHERE state = 1");
                    foreach ($complains
                             as $row) { ?>
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons green-text">drafts</i><span>Issue No.:  <b><?php echo $row['issue_no'] . " " ?></b>Issue Date:  <b><?php echo $row['issue_date'] . " " ?></b>Complainant: <b><?php echo $row['student_id'] . " " ?></b></span>
                            </div>
                            <div class="collapsible-body blue-grey lighten-5">
                                <span><?php echo $row['complain'] ?></span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


style="
position: fixed;
right: 0;
bottom: 0;
left: 0;
padding: 1rem;
background-color: #efefef;
text-align: center;"
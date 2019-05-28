
<!-- Invoice list -->
<div class="block">
    <h6 class="heading-hr">
        <i class="icon-stack"></i> Countries list
        <div class="label label-danger pull-right">
            <a style="color: white" href="<?=  site_url('cities/addCity');?>">Add New City</a>
        </div>
    </h6>
    <div class="datatable">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="invoice-number">#</th>
                    <th>City Name</th>
                    <th class="invoice-expand text-center">Edit</th>
                    <th class="invoice-expand text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cities as $key => $city) {?>
                <tr>
                    <td><?=$key+1;?></td>
                    <td><?=$city->cityName;?></td>
                    <td><a href="<?=  site_url('cities/addCity/'.$city->id);?>"><i class="icon-wrench"></i></a></td>
                    <td><a href="<?=  site_url('cities/delCity/'.$city->id);?>" onclick="return confirm('By Deleting a city You Delete All its Cities. Are You Sure You Want To?')" ><i class="icon-remove"></i></a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>


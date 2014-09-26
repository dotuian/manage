<tr>
    <td><?php echo $data['code']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['sex']==='M' ? '男' : '女'; ?></td>
    <td><?php echo $data['id_card_no']; ?></td>
    <td><?php echo $data['birthday']; ?></td>
    <td><?php echo $data['class_name']; ?></td>
    <td>
        <div class="btn-group">
            <button class="btn btn-xs btn-success"><i class="fa fa-check"></i> </button>
            <button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
            <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i> </button>
        </div>
    </td>
</tr>

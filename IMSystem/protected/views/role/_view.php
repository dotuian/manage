<tr>
    <td class="center"><?php echo $data['role_name']; ?></td>
    <td class="center"><?php echo $data['create_time']; ?></td>
    <td class="center"><?php echo $data['update_time']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('role/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>

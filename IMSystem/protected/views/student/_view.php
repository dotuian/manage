<tr>
    <td class="center"><?php echo $data['province_code']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['sex'] === 'M' ? '男' : '女'; ?></td>
    <td><?php echo $data['school_year']; ?></td>
    <td class="center"><?php echo $data['birthday']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('student/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>
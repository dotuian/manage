<tr>
    <td class="center"><?php echo $data['code']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['sex'] === 'M' ? '男' : '女'; ?></td>
    <td class="center"><?php echo $data['status'] === '1' ? '正常' : '异常'; ?></td>
    <td><?php echo $data['home_address']; ?></td>
    <td class="center"><?php echo $data['telephonoe']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('teacher/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>

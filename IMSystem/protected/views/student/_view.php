<tr>
    <td class="center"><?php echo $data['code']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['sex'] === 'M' ? '男' : '女'; ?></td>
    <td><?php echo $data['id_card_no']; ?></td>
    <td class="center"><?php echo $data['birthday']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('teacher/modifyStudent', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>

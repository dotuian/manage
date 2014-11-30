<tr>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['sex'] === 'M' ? '男' : '女'; ?></td>
    <td class="center"><?php echo $data['birthday']; ?></td>
    <td class="center"><?php echo $data['id_card_no']; ?></td>
    <td><?php echo $data['home_address']; ?></td>
    <td class="center"><?php echo $data['telephone']; ?></td>
    
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $data['status'] === '1' ? '在校' : '离校'; ?></span>
    </td>
    
    <td class="center">
        <?php if(in_array('teacher/update', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('teacher/update', array('ID' => $data['ID'])) ?>">详细</a>
        <?php } ?>
    </td>
</tr>

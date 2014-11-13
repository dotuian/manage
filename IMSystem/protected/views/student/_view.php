<tr>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo $data['student_number']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php if($data['sex'] == 'M') echo '男' ; if($data['sex'] == 'F') echo '女'; ?></td>
    <td class="center"><?php echo $data['school_year']; ?></td>
    <td class="center"><?php echo $data['birthday']; ?></td>
    <td class="center">
        <?php if(in_array('student/update', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('student/update', array('ID' => $data['ID'])) ?>">详细</a>
        <?php } ?>
        
    </td>
</tr>
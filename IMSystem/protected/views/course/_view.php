<tr>
    <td class="center"><?php echo $data['class_code']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo $data['subject_name']; ?></td>
    <!--<td class="center"><?php echo $data['teacher_code']; ?></td>-->
    <td class="center"><?php echo $data['teacher_name']; ?></td>
    <td class="center">
        <?php if(in_array('course/update', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('course/update', array('ID' => $data['ID'])) ?>">详细</a>
        <?php } ?>
    </td>
</tr>

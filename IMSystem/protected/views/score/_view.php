<tr>
    <td class="center"><?php echo $data['exam_name'] ; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo $data['subject_name'] ; ?></td>
    <td class="center"><?php echo $data['student_number']; ?></td>
    <td class="center"><?php echo $data['name']; ?></td>
    <td class="center"><?php echo $data['score'] ; ?></td>
    
    <td class="center">
        <?php if(in_array('student/search', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('score/update', array('ID' => $data['ID'])) ?>">详细</a>
        <?php } ?>
    </td>
</tr>

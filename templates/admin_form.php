<div>
    <label for="title">Quiz Title:</label>
    <input type="text" id="title" name="title" value="<?php echo isset($quiz['title']) ? $quiz['title'] : ''; ?>" required>
</div>
<div>
    <label for="question">Question:</label>
    <textarea id="question" name="question" required><?php echo isset($quiz['question']) ? $quiz['question'] : ''; ?></textarea>
</div>
<div>
    <label for="answer">Answer:</label>
    <textarea id="answer" name="answer" required><?php echo isset($quiz['answer']) ? $quiz['answer'] : ''; ?></textarea>
</div>
<div>
    <button type="submit">Save</button>
</div>
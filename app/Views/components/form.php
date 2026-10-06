<form action="<?= esc($action) ?>" method="<?= esc($method ?? 'POST') ?>" <?= $attributes ?? '' ?>>

    <?php foreach ($fields as $field): ?>

        <div class="mb-3">
            <label for="<?= esc($field['name']) ?>" class="form-label">
                <?= esc($field['label']) ?>
            </label>

            <?php if (($field['type'] ?? 'text') === 'select'): ?>

                <select
                    name="<?= esc($field['name']) ?>"
                    id="<?= esc($field['name']) ?>"
                    class="form-select">
                    <?php foreach ($field['options'] as $value => $label): ?>
                        <option
                            value="<?= esc($value) ?>"
                            <?= ($field['value'] ?? '') == $value ? 'selected' : '' ?>>
                            <?= esc($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            <?php else: ?>

                <input
                    type="<?= esc($field['type'] ?? 'text') ?>"
                    name="<?= esc($field['name']) ?>"
                    id="<?= esc($field['name']) ?>"
                    value="<?= esc($field['value'] ?? '') ?>"
                    class="form-control">

            <?php endif; ?>
        </div>

    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">
        <?= esc($submitText ?? 'Submit') ?>
    </button>

</form>
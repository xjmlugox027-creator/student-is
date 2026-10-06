<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>

<?php if ($pager->getPageCount() > 1) : ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mb-0">

            <!-- First -->
            <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
                <?php if ($pager->hasPrevious()) : ?>
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                <?php else : ?>
                    <span class="page-link" aria-hidden="true">&laquo;&laquo;</span>
                <?php endif ?>
            </li>

            <!-- Previous -->
            <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
                <?php if ($pager->hasPrevious()) : ?>
                    <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php else : ?>
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                <?php endif ?>
            </li>

            <!-- Page Numbers -->
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <!-- Next -->
            <li class="page-item <?= $pager->hasNext() ? '' : 'disabled' ?>">
                <?php if ($pager->hasNext()) : ?>
                    <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php else : ?>
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                <?php endif ?>
            </li>

            <!-- Last -->
            <li class="page-item <?= $pager->hasNext() ? '' : 'disabled' ?>">
                <?php if ($pager->hasNext()) : ?>
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                <?php else : ?>
                    <span class="page-link" aria-hidden="true">&raquo;&raquo;</span>
                <?php endif ?>
            </li>

        </ul>
    </nav>
<?php endif ?>
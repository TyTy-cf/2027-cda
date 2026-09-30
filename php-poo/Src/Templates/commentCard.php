<div class="col-12 border-start border-secondary m-0 p-0 mb-2">
    <div class="row border-start border-secondary border-3 m-0">
        <div class="col-12 p-0">
            <div class="row">
                <div class="col-auto ps-4 pe-0"><img
                            src="<?= 'https://picsum.photos/id/' . $comment->author->id . '/200/200' ?>"
                            class="img-thumbnail rounded-circle d-flex" style="width:40px;height:40px;"></div>
                <h6 class="my-auto text-body-secondary col-auto"><?= $comment->author->nickname ?></h6>
            </div>
        </div>
        <p><?= $comment->content ?></p>
    </div>
    <?php if ($comment->getChildren() !== []): ?>
        <div class="row ms-5">
            <?php foreach ($comment->getChildren() as $comment) {
                include "commentCard.php";
            }
            ?>
        </div>
    <?php endif; ?>
</div>
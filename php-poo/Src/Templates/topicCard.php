<div class="col-6 p-2">
    <div class="card">
        <h5 class="m-2 h5">Catégorie <?php if (isset($topic->category->parent)): ?> <?= $topic->category->parent->name . ' -> ' ?> <?php endif; ?> <?= $topic->category->name ?></h5>
        <div class="ratio ratio-21x9">
            <img src="<?= 'https://picsum.photos/id/' . $topic->id . '/400/300' ?>" class="card-img-top object-fit-cover" alt="...">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $topic->title ?></h5>
            <p class="card-text my-3"><?= $topic->content ?></p>
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="my-auto col-auto"><?= $topic->createdAt->format('Y-m-d H:i:s'); ?></div>
                <div class="col-auto">
                    <div class="row">
                    <h6 class="my-auto text-body-secondary col-auto"><?= $topic->author->nickname ?></h6>
                    <div class="col-auto ps-0"><img src="<?= 'https://picsum.photos/id/' . $topic->author->id . '/200/200' ?>" class="img-thumbnail rounded-circle d-flex" style="width:40px;height:40px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
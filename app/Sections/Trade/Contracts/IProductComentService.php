<?php

namespace App\Sections\Trade\Contracts;

interface IProductCommentService
{
    /**
     * Create new product comment.
     *
     * @param array $inputs
     *
     * @return \App\Models\ProductComment
     */
    public function create($inputs);

    /**
     * Update product comment.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs);

    /**
     * Delete product from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id);

    /**
     * Abort(404) if product comment not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id);
}

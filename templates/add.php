                <h2 class="content__main-heading">Добавление задачи</h2>

                <form class="form"  action="index.html" method="post">
                    <div class="form__row">
                        <label class="form__label" for="project[name]">Название <sup>*</sup></label>

                        <input class="form__input" type="text" name="project[name]" id="name" value="" placeholder="Введите название">
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="project[category]">Проект <sup>*</sup></label>

                        <select class="form__input form__input--select" name="project[category]" id="project">
                            <option value="">Выберите категорию</option>
                            <?php foreach ($categories as $catname): ?>
                                <option value="<?=$catname['id'] ?>"><?=$catname['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="project[date]">Дата выполнения</label>

                        <input class="form__input form__input--date" type="date" name="project[date]" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
                    </div>

                    <div class="form__row">
                        <label class="form__label" for="preview">Файл</label>

                        <div class="form__input-file">
                            <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                            <label class="button button--transparent" for="preview">
                                <span>Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <div class="form__row form__row--controls">
                        <input class="button" type="submit" name="" value="Добавить">
                    </div>
                </form>

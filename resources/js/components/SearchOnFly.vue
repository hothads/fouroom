<template>

    <ais-instant-search
        :search-client="searchClient"
        index-name="threads"
    >

        <div class="container mx-auto my-6">

            <div class="flex items-center justify-between py-6 mb-6">
                <ais-search-box placeholder="Поиск" autofocus v-model="searchQuery"/>
            </div>

            <div class="flex">
                <div class="w-2/3 mr-12">

                    <ais-hits>
                        <template
                            slot="item"
                            slot-scope="{ item }"
                        >
                            <div class="forum-card">
                                <div class="forum-header">
                                    <div>
                                        <h2>
                                            <a :href="item.path">
                                                <ais-highlight :hit="item" attribute="title"/>
                                            </a>
                                        </h2>
                                    </div>
                                </div>

                                <div class="forum-body">
                                    <article>
                                        <ais-highlight :hit="item" attribute="body"/>
                                    </article>
                                    <h5>Автор:
                                        <a :href="'/profiles/' + item.creator.name"><span
                                            v-text="item.creator.name"></span></a>
                                    </h5>
                                </div>


                            </div>

                        </template>
                    </ais-hits>
                </div>

                <div class="w-1/3">

                    <div>
                        <h3 class="font-bold text-gray-700 text-xl mb-3 pt-3">Популярное</h3>
                        <slot></slot>
                    </div>



                    <div>
                        <h3 class="font-bold text-gray-700 text-xl mb-3 pt-6">Рубрики</h3>

                        <div>
                            <ais-refinement-list attribute="channel.name"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
    data() {
        return {
            searchQuery: this.value,
            searchClient: algoliasearch(
                process.env.MIX_ALGOLIA_APP_ID,
                process.env.MIX_ALGOLIA_SEARCH
            ),
        };
    },
    props: ['value']
};
</script>



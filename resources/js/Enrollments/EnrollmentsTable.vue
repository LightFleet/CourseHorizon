<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Название курса</th>
                <th>Имя пользователя</th>
                <th>Результат</th>
                <th>Дата записи на курс</th>
                <th>Дата завершения курса</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="enrollment in enrollments" :key="enrollment.id">
                    <td>{{ enrollment.course_title }}</td>
                    <td>{{ enrollment.student_name }}</td>
                    <td><span :class="{ 'text-warning': enrollment.status == 'In Progress', 'text-success': enrollment.status == 'Completed' }">{{ enrollment.status }}</span></td>
                    <td>{{ enrollment.created_at }}</td>
                    <td>{{ enrollment.completed_at }}</td>
                </tr>
            </tbody>
        </table>
        <button @click="fetchData">Обновить данные</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            enrollments: [],
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await fetch('/api/enrollments');
                const data = await response.json();
                this.enrollments = await data.enrollments;
            } catch (error) {
                console.error('Ошибка при получении данных:', error);
            }
        },
    },
};
</script>

<style scoped>

</style>

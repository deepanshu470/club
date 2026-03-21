package com.deepanshu.dk.work

import android.content.Context
import androidx.work.CoroutineWorker
import androidx.work.WorkerParameters
import com.deepanshu.dk.db.DKDatabase
import com.deepanshu.dk.db.DKMemory

class BackgroundThinkWorker(
    appContext: Context,
    params: WorkerParameters
) : CoroutineWorker(appContext, params) {

    override suspend fun doWork(): Result {
        val query = inputData.getString(KEY_QUERY) ?: return Result.failure()

        // Placeholder: run offline reasoning or deferred AI call
        val response = processQuery(query)

        DKDatabase.getInstance(applicationContext)
            .memoryDao()
            .insert(DKMemory(role = "dk", content = response))

        return Result.success()
    }

    private fun processQuery(query: String): String {
        // TODO: replace with real offline NLP / API call
        return "DK background response to: $query"
    }

    companion object {
        const val KEY_QUERY = "query"
    }
}

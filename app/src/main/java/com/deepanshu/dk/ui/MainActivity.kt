package com.deepanshu.dk.ui

import android.content.Intent
import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.material3.Button
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.material3.darkColorScheme
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.unit.dp
import com.deepanshu.dk.services.DKMasterService

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            MaterialTheme(colorScheme = darkColorScheme()) {
                DKDashboard(
                    onStart = {
                        startService(Intent(this, DKMasterService::class.java).apply {
                            action = DKMasterService.ACTION_START_LISTENING
                        })
                    },
                    onStop = {
                        startService(Intent(this, DKMasterService::class.java).apply {
                            action = DKMasterService.ACTION_STOP_LISTENING
                        })
                    }
                )
            }
        }
    }
}

@OptIn(ExperimentalMaterial3Api::class)
@Composable
private fun DKDashboard(onStart: () -> Unit, onStop: () -> Unit) {
    Scaffold(
        topBar = { TopAppBar(title = { Text("DK — Boss Deepanshu") }) }
    ) { padding ->
        Column(
            modifier = Modifier
                .fillMaxSize()
                .padding(padding)
                .padding(16.dp)
        ) {
            Text("Core Controls", style = MaterialTheme.typography.titleLarge)
            Spacer(modifier = Modifier.height(12.dp))
            Button(onClick = onStart) { Text("Start Listening") }
            Spacer(modifier = Modifier.height(8.dp))
            Button(onClick = onStop) { Text("Stop Listening") }
            Spacer(modifier = Modifier.height(16.dp))
            Text(
                text = "DK AI Assistant — foreground service, notifications,\n" +
                        "accessibility, call screening, Room DB & WorkManager.",
                style = MaterialTheme.typography.bodyMedium
            )
        }
    }
}

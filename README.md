# Sistemas Reservas
Sistemas de reservas para hotéis e restaurantes. Este sistema deverá permitir realizar consultas do estado das reservas feitas nos referentes estabelecimentos.
Este deve ter:
* Interface para clientes e administradores.
* Calendário de disponibilidade, confirmação por e-mail.


## CREATE TABLE RESERVAS
``` CREATE TABLE reservas ( ```
    ```id INT AUTO_INCREMENT PRIMARY KEY,```

```codigo_reserva VARCHAR(20) NOT NULL UNIQUE,```

   ``` user_id INT NOT NULL, estabelecimento_id INT NOT NULL,```

 ``` data_reserva DATE NOT NULL, hora_inicio TIME NOT NULL, hora_fim TIME NOT NULL,```

```estado ENUM('pendente','confirmada','cancelada') NOT NULL DEFAULT 'pendente',```

```created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ```

```CONSTRAINT fk_reservas_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,```

```CONSTRAINT fk_reservas_estabelecimento FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id) ON DELETE CASCADE, ```

```INDEX idx_data_estabelecimento (data_reserva, estabelecimento_id), INDEX idx_codigo_reserva (codigo_reserva));```


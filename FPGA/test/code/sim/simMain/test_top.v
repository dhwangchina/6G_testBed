/*
*                                        
* File  : test_top.v
* Author: Duohua(Edward) Wang
* Init  : 09/20/2021
*/

`timescale 1ns/100ps

module test_top();


//(*mark_debug = "true" *)
//(*mark_debug = "true" *)
wire sim_clk ;
wire sim_rst ;
wire sim_rstn;
 
sim_clk_rst U_sim_clk_rst_inst
(
    .O_clk  (sim_clk ),
    .O_rst  (sim_rst ),
    .O_rstn (sim_rstn) 
);

wire detectSignal;

comCounter #
(
    .C_COUNT_NUM (100)
)
U_comCounter_inst
(
    .I_clk    (sim_clk     ),
    .I_rst    (sim_rst     ),
    .O_cntFlg (detectSignal) 
);

wire fFlg;

fallingEdgeFlg U_fallingEdgeFlg_inst
(
    .I_clk              (sim_clk     ),
    .I_rst              (sim_rst     ),
    .I_sigUnderDetect   (detectSignal),
    .O_fallingEdgeFlg   (fFlg        ) 
);

wire rFlg;
raisingEdgeFlg U_raisingEdgeFlg_inst
(
    .I_clk            (sim_clk     ),
    .I_rst            (sim_rst     ),
    .I_sigUnderDetect (detectSignal),
    .O_raisingEdgeFlg (rFlg        ) 
);

wire S_val;
localparam C_DELAY_NUM = 10'd10;
reg [31:0] S_data = 32'd0;

always @ (posedge sim_clk)
    begin
        if(sim_rst)
            S_data <= 32'd0;
        else
            S_data <= S_data + 1;
    end

comDelay #
(
    .C_DELAY_CLK_NUM (C_DELAY_NUM) 
)
U_comDelay_inst
(
    .I_clk       (sim_clk ),
    .I_rst       (sim_rst ),
    .I_srcData   (S_data  ),
    .O_dstData   (        ) 
);

comPulseShift #
(
    .C_SHIFT_NUM (C_DELAY_NUM)
)
U_comPulseShift_inst
(
    .I_clk        (sim_clk),
    .I_rst        (sim_rst),
    .I_impulse    (rFlg   ),
    .O_pulseShift (       )  
);

comPulseDelay #
(
    .C_SHIFT_NUM (C_DELAY_NUM)
)
U_comPulseDelay_inst
(
    .I_clk        (sim_clk),
    .I_rst        (sim_rst),
    .I_pulse      (rFlg   ),
    .O_pulseDelay (       ) 
);

wire        T_singleToneEn;
wire [15:0] T_singleToneIm;
wire [15:0] T_singleToneRe;

singleToneGen U_singleToneGen_inst
(
    .I_clk    (sim_clk       ),
    .I_rst    (sim_rst       ),
    .I_rReady (1'b1          ),
    .O_dataEn (T_singleToneEn),
    .O_dataIm (T_singleToneIm),
    .O_dataRe (T_singleToneRe) 
);
wire        S_RF_txXEn;
wire [11:0] S_RF_tx0Im;
wire [11:0] S_RF_tx0Re;
wire [11:0] S_RF_tx1Im;
wire [11:0] S_RF_tx1Re;
stub_RF_DataGen U_stub_RF_DataGen_inst
(
    .I_clk      (sim_clk   ),
    .I_rst      (sim_rst   ),
    .I_tReady   (1'b1      ),
    .O_RF_txXEn (S_RF_txXEn),
    .O_RF_tx0Im (S_RF_tx0Im),
    .O_RF_tx0Re (S_RF_tx0Re),
    .O_RF_tx1Im (S_RF_tx1Im),
    .O_RF_tx1Re (S_RF_tx1Re) 
);

wire        S_SeqDataEn;
wire [31:0] S_SeqData  ;

sequenceDataGen U_sequenceDataGen_inst
(
    .I_clk    (sim_clk    ),
    .I_rst    (sim_rst    ),
    .I_rReady (1'b1       ),
    .O_DataEn (S_SeqDataEn),
    .O_Data   (S_SeqData  ) 
);

wire        S_ppDataEn;
wire [31:0] S_ppData  ;

assign S_ppDataEn = S_SeqDataEn;
assign S_ppData   = S_SeqData  ;

pingpangBufCtl #
(
    .C_WDATA_WIDTH (32),
    .C_WADDR_WIDTH (16) 
)
U_DataPingpangBufCtl_inst
(
    .I_clk     (sim_clk   ),
    .I_rst     (sim_rst   ),
    .I_wReady  (1'b1      ),
    .I_wDataEn (S_ppDataEn),
    .I_wData   (S_ppData  ),
    .I_rReady  (1'b1      ),
    .O_rDataEn (),
    .O_rData   () 
);


endmodule

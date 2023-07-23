/*
*                                        
* File  : pingpangBufCtl.v
* Author: Duohua(Edward) Wang
* Init  : 09/29/2021
*/

`timescale 1ns/100ps

module pingpangBufCtl #
(
    parameter C_WDATA_WIDTH = 32'd32,
    parameter C_WADDR_WIDTH = 32'd16 
)
(
    input                      I_clk    ,
    input                      I_rst    ,
    input                      I_wReady ,
    input                      I_wDataEn,
    input  [C_WDATA_WIDTH-1:0] I_wData  ,
    input                      I_rReady ,
    output                     O_rDataEn,
    output [C_WDATA_WIDTH-1:0] O_rData   
);

localparam C_BRAMDATA_NUM = 20;//2^C_WADDR_WIDTH;
localparam C_BRAM_OFFSET  = 0;

/* Write data into Brams continously*/
reg                     S_Bram0_wEn     = 1'b0;
reg [C_WDATA_WIDTH-1:0] S_Bram0_wData   = 0;
reg [C_WADDR_WIDTH-1:0] S_Bram0_wAddr   = 0;
reg                     S_Bram1_wEn     = 1'b0;
reg [C_WDATA_WIDTH-1:0] S_Bram1_wData   = 0;
reg [C_WADDR_WIDTH-1:0] S_Bram1_wAddr   = 0;
reg [             31:0] S_BramX_wCnt    = 32'd0;
reg [              3:0] S_BramX_wState  = 4'd0;
reg                     S_Bram0_rValid  = 1'b0;
reg                     S_Bram1_rValid  = 1'b0;

always @ (posedge I_clk)
    begin
        if(I_rst || !I_wReady)
            begin
                S_Bram0_wEn     <= 1'b0;
                S_Bram0_wAddr   <= 0;
                S_Bram0_wData   <= 0;
                S_Bram1_wEn     <= 1'b0;
                S_Bram1_wAddr   <= 0;
                S_Bram1_wData   <= 0;
                S_BramX_wCnt    <= 32'd0;
                S_Bram0_rValid  <= 1'b0;
                S_Bram1_rValid  <= 1'b0;
                S_BramX_wState  <= 4'd0;
            end
        else
            begin
                case(S_BramX_wState)
                    4'd0://Initilization
                        begin
                            S_Bram0_rValid <= 1'b0;
                            
                            S_Bram1_rValid <= 1'b0;
                            S_Bram1_wEn    <= 1'b0;
                            S_Bram1_wAddr  <= 0;
                            S_Bram1_wData  <= 0;
                            if(I_wDataEn == 1'b1)
                                begin
                                    S_Bram0_wEn    <= 1'b1;
                                    S_Bram0_wAddr  <= C_BRAM_OFFSET;
                                    S_Bram0_wData  <= I_wData;
                                    S_BramX_wCnt   <= 32'd1;
                                    S_BramX_wState <= 4'd1;
                                end
                            else
                                begin
                                    S_Bram0_wEn    <= 1'b0;
                                    S_Bram0_wAddr  <= 0;
                                    S_Bram0_wData  <= 0;
                                    S_BramX_wCnt   <= 32'd0;
                                    S_BramX_wState <= 4'd0;
                                end
                        end
                    4'd1://Bram0
                        begin
                            if((I_wDataEn == 1'b1) && (C_BRAMDATA_NUM == S_BramX_wCnt))
                                begin
                                    S_Bram0_wEn    <= 1'b0;
                                    S_Bram0_wAddr  <= 0;
                                    S_Bram0_wData  <= 0;
                                    S_Bram1_rValid <= 1'b0;

                                    S_Bram0_rValid <= 1'b1;
                                    S_Bram1_wEn    <= 1'b1;
                                    S_Bram1_wAddr  <= C_BRAM_OFFSET;
                                    S_Bram1_wData  <= I_wData;
                                    S_BramX_wCnt   <= 32'd1;
                                    S_BramX_wState <= 4'd2;
                                end
                            else if(I_wDataEn == 1'b1)
                                begin
                                    S_Bram1_wEn    <= 1'b0;
                                    S_Bram1_wAddr  <= 0;
                                    S_Bram1_wData  <= 0;

                                    S_Bram0_wEn    <= 1'b1;
                                    S_Bram0_wAddr  <= S_Bram0_wAddr + 1;
                                    S_Bram0_wData  <= I_wData;
                                    S_BramX_wCnt   <= S_BramX_wCnt + 32'd1;
                                    S_BramX_wState <= 4'd1;
                                end
                            else
                                begin
                                    S_Bram0_wEn    <= 1'b0;
                                    S_Bram0_wAddr  <= S_Bram0_wAddr;
                                    S_Bram0_wData  <= S_Bram0_wData;
                                    S_BramX_wCnt   <= S_BramX_wCnt;
                                    S_BramX_wState <= 4'd1;
                                end
                        end
                    4'd2://Bram1
                        begin
                            if((I_wDataEn == 1'b1) && (C_BRAMDATA_NUM == S_BramX_wCnt))
                                begin
                                    S_Bram1_wEn    <= 1'b0;
                                    S_Bram1_wAddr  <= 0;
                                    S_Bram1_wData  <= 0;
                                    S_Bram0_rValid <= 1'b0;
                                    
                                    S_Bram1_rValid <= 1'b1;
                                    S_Bram0_wEn    <= 1'b1;
                                    S_Bram0_wAddr  <= C_BRAM_OFFSET;
                                    S_Bram0_wData  <= I_wData;
                                    S_BramX_wCnt   <= 32'd1;
                                    S_BramX_wState <= 4'd1;
                                end
                            else if(I_wDataEn == 1'b1)
                                begin
                                    S_Bram0_wEn    <= 1'b0;
                                    S_Bram0_wAddr  <= 0;
                                    S_Bram0_wData  <= 0;

                                    S_Bram1_wEn    <= 1'b1;
                                    S_Bram1_wAddr  <= S_Bram1_wAddr + 1;
                                    S_Bram1_wData  <= I_wData;
                                    S_BramX_wCnt   <= S_BramX_wCnt + 32'd1;
                                    S_BramX_wState <= 4'd2;
                                end
                            else
                                begin
                                    S_Bram1_wEn    <= 1'b0;
                                    S_Bram1_wAddr  <= S_Bram1_wAddr;
                                    S_Bram1_wData  <= S_Bram1_wData;
                                    S_BramX_wCnt   <= S_BramX_wCnt;
                                    S_BramX_wState <= 4'd2;
                                end
                        end
                    default:
                        begin
                            S_Bram0_wEn     <= 1'b0;
                            S_Bram0_wAddr   <= 0;
                            S_Bram0_wData   <= 0;
                            S_Bram1_wEn     <= 1'b0;
                            S_Bram1_wAddr   <= 0;
                            S_Bram1_wData   <= 0;
                            S_BramX_wCnt    <= 32'd0;
                            S_Bram0_rValid  <= 1'b0;
                            S_Bram1_rValid  <= 1'b0;
                            S_BramX_wState  <= 4'd0;
                        end
                endcase
            end
    end

/* Read data from Brams according to command*/
reg                      S_BramX_rAddrEn = 1'b0;
reg  [C_WADDR_WIDTH-1:0] S_BramX_rAddr   = 0;
reg  [             31:0] S_BramX_rCnt    = 32'd0;
reg  [              3:0] S_BramX_rState  = 4'd0;

always @ (posedge I_clk)
    begin
        if(I_rst || !I_rReady)
            begin
                S_BramX_rAddrEn <= 1'b0;
                S_BramX_rAddr   <= 0;
                S_BramX_rCnt    <= 32'd0;
                S_BramX_rState  <= 4'd0;
            end
        else
            begin
                case(S_BramX_rState)
                    4'd0:
                        begin
                            if(S_Bram0_rValid || S_Bram1_rValid)
                                begin
                                    S_BramX_rAddrEn <= 1'b1;
                                    S_BramX_rAddr   <= 0;
                                    S_BramX_rCnt    <= S_BramX_rCnt + 1;
                                    S_BramX_rState  <= 4'd1;
                                end
                            else
                                begin
                                    S_BramX_rAddrEn <= 1'b0;
                                    S_BramX_rAddr   <= 0;
                                    S_BramX_rCnt    <= 32'd0;
                                    S_BramX_rState  <= 4'd0;
                                end
                        end
                    4'd1:
                        begin
                            if(C_BRAMDATA_NUM == S_BramX_rCnt)
                                begin
                                    if(S_Bram0_rValid || S_Bram1_rValid)
                                        begin
                                            S_BramX_rAddrEn <= 1'b1;
                                            S_BramX_rCnt    <= 1;
                                        end
                                    else
                                        begin
                                            S_BramX_rAddrEn <= 1'b0;
                                            S_BramX_rCnt    <= 0;
                                        end
                                    
                                    S_BramX_rAddr  <= 0;
                                    S_BramX_rState <= 4'd1;
                                end
                            else if(S_Bram0_rValid || S_Bram1_rValid)
                                begin
                                    S_BramX_rAddrEn <= 1'b1;
                                    S_BramX_rAddr   <= S_BramX_rAddr + 1;
                                    S_BramX_rCnt    <= S_BramX_rCnt + 1;
                                    S_BramX_rState  <= 4'd1;
                                end
                            else
                                begin
                                    S_BramX_rAddrEn <= 1'b0;
                                    S_BramX_rAddr   <= S_BramX_rAddr;
                                    S_BramX_rCnt    <= S_BramX_rCnt;
                                    S_BramX_rState  <= 4'd1;
                                end
                        end
                    default:
                        begin
                            S_BramX_rAddrEn <= 1'b0;
                            S_BramX_rAddr   <= 0;
                            S_BramX_rCnt    <= 32'd0;
                            S_BramX_rState  <= 4'd0;
                        end
                endcase
            end
    end

wire                     S_BramX_rDataEn;
wire [C_WDATA_WIDTH-1:0] S_Bram0_rData  ;
wire [C_WDATA_WIDTH-1:0] S_Bram1_rData  ;

wire D_Bram0_rValid;
wire D_Bram1_rValid;

comPulseShift #
(
    .C_SHIFT_NUM  (2              )
)
U_BramX_rDataEn_inst
(
    .I_clk        (I_clk          ),
    .I_rst        (I_rst          ),
    .I_impulse    (S_BramX_rAddrEn),
    .O_pulseShift (S_BramX_rDataEn)  
);

comPulseShift #
(
    .C_SHIFT_NUM  (3              )
)
U_Bram0_rValid_inst
(
    .I_clk        (I_clk          ),
    .I_rst        (I_rst          ),
    .I_impulse    (S_Bram0_rValid),
    .O_pulseShift (D_Bram0_rValid)  
);

comPulseShift #
(
    .C_SHIFT_NUM  (3              )
)
U_Bram1_rValid_inst
(
    .I_clk        (I_clk          ),
    .I_rst        (I_rst          ),
    .I_impulse    (S_Bram1_rValid),
    .O_pulseShift (D_Bram1_rValid)  
);


/* Brams */

blk_mem_gen_32Wx65535D U_Bram0_inst
(
    .clka   (I_clk        ),
    .wea    (S_Bram0_wEn  ),
    .addra  (S_Bram0_wAddr),
    .dina   (S_Bram0_wData),
    .clkb   (I_clk        ),
    .addrb  (S_BramX_rAddr),
    .doutb  (S_Bram0_rData) 
);

blk_mem_gen_32Wx65535D U_Bram1_inst
(
    .clka   (I_clk        ),
    .wea    (S_Bram1_wEn  ),
    .addra  (S_Bram1_wAddr),
    .dina   (S_Bram1_wData),
    .clkb   (I_clk        ),
    .addrb  (S_BramX_rAddr),
    .doutb  (S_Bram1_rData) 
);

/* Output data*/
assign O_rDataEn = S_BramX_rDataEn;
assign O_rData   = (D_Bram0_rValid == 1'b1)? S_Bram0_rData : ((D_Bram1_rValid == 1'b1)? S_Bram1_rData: 0);

endmodule
